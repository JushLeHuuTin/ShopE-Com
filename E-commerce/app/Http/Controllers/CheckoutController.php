<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\DiscountCode;


class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        // dd($request);
        $userId = Auth::id() ?? 1;

        // Lấy địa chỉ giao hàng
        $shippingAddress = ShippingAddress::where('id_user', $userId)->first();
        $selectedCartIds = $request->input('selected', []); // là mảng id_cart
        // dd($selectedCartIds);
        // Lấy các item trong giỏ hàng và load variant + product
        // Lấy các cart item đã chọn
        $cartItems = Cart::where('id_user', $userId)
            ->whereIn('id_cart', $selectedCartIds)
            ->with(['variant.product'])
            ->get();



        // ✅ Tạm tính
        $subtotal = $cartItems->sum(function ($item) {
            return $item->variant->price * $item->quantity;
        });

        // ✅ Giảm giá (voucher từ session hoặc gán tạm)
        $discount = (int) session('discount_value', 0); // nếu có voucher
        $shippingFee = 30000;

        // ✅ Tổng thanh toán
        $total = max($subtotal - $discount + $shippingFee, 0);

        return view('checkout', compact('shippingAddress', 'cartItems', 'total', 'selectedCartIds'));
    }

    public function selectAddress()
    {
        $userId = Auth::id() ?? 1; // Tạm gán cứng nếu chưa login
        $addresses = ShippingAddress::where('id_user', $userId)->get();

        return view('checkout.select_address', compact('addresses'));
    }

    public function clearSession()
    {
        session()->forget('selected_cart_ids');
        return response()->json(['status' => 'ok']);
    }

    //Xử lý mã giảm giá
    //  public function applyDiscount(Request $request)
    // {
    //     $request->validate([
    //         'code' => 'required|string'
    //     ]);

    //     $code = strtoupper($request->code);
    //     $discount = DiscountCode::where('code', $code)->first();

    //     if (!$discount) {
    //         return response()->json(['success' => false, 'message' => 'Mã không tồn tại.']);
    //     }

    //     if ($discount->expiration_date < now()) {
    //         return response()->json(['success' => false, 'message' => 'Mã đã hết hạn.']);
    //     }

    //     if ($discount->max_uses <= 0) {
    //         return response()->json(['success' => false, 'message' => 'Mã đã được dùng hết.']);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'discount_value' => $discount->discount_value
    //     ]);
    // }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $couponCode = trim($request->input('coupon_code'));

        // Find discount code (case insensitive)
        $discount = DiscountCode::whereRaw('LOWER(code) = ?', [strtolower($couponCode)])->first();

        if (!$discount) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá không tồn tại.'
            ]);
        }

        $now = Carbon::now();

        if ($discount->expiration_date < $now) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá đã hết hạn.'
            ]);
        }

        $usageCount = Invoice::where('id_discount', $discount->id_discount)->count();

        if ($usageCount >= $discount->max_uses) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá đã đạt giới hạn số lần sử dụng.'
            ]);
        }

        return response()->json([
            'valid' => true,
            'discountPercent' => floatval($discount->discount_value),
            'message' => 'Mã giảm giá áp dụng thành công.'
        ]);
    }

    public function placeOrder(Request $request)
    {
        // $selected = $request->input('selected', []);
        $selected = $request->input('selected', '');
        $selectedArray = explode(',', $selected);



        if (empty($selectedArray)) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào được chọn.');
        }

        DB::beginTransaction();

        try {
            $userId = Auth::check() ? Auth::id() : null;
            $coupon = session('coupon');
            $discountId = $coupon['id_discount'] ?? null;
            $cartItems = \App\Models\Cart::where('id_user', $userId)
                ->whereIn('id_cart', $selectedArray)
                ->with('variant')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Không tìm thấy sản phẩm hợp lệ trong giỏ.');
            }

            $total = $request->tong_thanhtoan ?? 0;

            // Tạo hóa đơn
            $invoiceId = DB::table('invoices')->insertGetId([
                'id_user' => $userId,
                'id_discount' => $discountId,
                'total_amount' => $total,
                'invoice_date' => Carbon::now(),
                'status' => 'pending',
                'payment_method' => $request->payment_method ?? 'COD',
            ]);

            foreach ($cartItems as $item) {
                DB::table('invoices_detail')->insert([
                    'id_invoice' => $invoiceId,
                    'id_variant' => $item->id_variant,
                    'quantity' => $item->quantity,
                    'price' => $item->variant->price,
                ]);
            }

            // Xóa cart trong DB
            Cart::where('id_user', $userId)->whereIn('id_cart', $selectedArray)->delete();

            // dd($invoiceId);
            DB::commit();

            // Gửi email xác nhận
            $user = Auth::user();


            if ($user && $user->email) {
                try {
                    Mail::to($user->email)->send(new OrderConfirmationMail([
                        'total_amount' => $request->tong_thanhtoan
                    ], $cartItems));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }

            // Xóa session
            session()->forget(['cart', 'coupon']);
            return redirect()->route('invoices.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đặt hàng thất bại: ' . $e->getMessage());
        }
    }
}
