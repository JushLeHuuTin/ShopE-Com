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


class CheckoutController extends Controller
{
    // public function show(Request $request)
    // {
    //     $selectedCartIds = $request->input('selected', []); // là mảng id_cart

    //     // Tạm thời chỉ dump ra để kiểm tra
    //     dd($selectedCartIds);
    // }

    // public function show(Request $request)
    // {
    //     // Tạm thời hardcode userId (vì bạn chưa có login)
    //     $userId = 1;

    //     // Lấy danh sách ID cart được chọn
    //     $selectedIds = $request->input('selected', []);

    //     if (empty($selectedIds)) {
    //         return redirect()->route('cart.index')->with('error', 'Bạn chưa chọn sản phẩm nào để thanh toán.');
    //     }

    //     // Lấy sản phẩm được chọn từ giỏ hàng
    //     $cartItems = \App\Models\Cart::with('variant.product')
    //         ->where('id_user', $userId)
    //         ->whereIn('id_cart', $selectedIds)
    //         ->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm hợp lệ.');
    //     }

    //     // Tính tạm tính
    //     $subtotal = $cartItems->sum(function ($item) {
    //         return $item->price * $item->quantity;
    //     });


    //     $discount = (int) session('discount_value', 0); // từ session nếu có
    //     $shippingFee = 30000;
    //     $total = max($subtotal - $discount + $shippingFee, 0);

    //     // Lấy địa chỉ giao hàng của user
    //    // $shippingAddress = \App\Models\ShippingAddress::where('id_user', $userId)->first();

    //     // Lấy địa chỉ giao hàng mặc định của user
    //     $shippingAddress = ShippingAddress::where('id_user', $userId)->first();

    //     // Truyền dữ liệu ra view
    //     return view('checkout', compact(
    //         'cartItems',
    //         'subtotal',
    //         'discount',
    //         'shippingFee',
    //         'total',
    //         'shippingAddress'
    //     ));
    // }
    public function show(Request $request)
    {
        $userId = Auth::id() ?? 1;

        // Lấy địa chỉ giao hàng
        $shippingAddress = ShippingAddress::where('id_user', $userId)->first();
        $selectedCartIds = $request->input('selected', []); // là mảng id_cart
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

        return view('checkout', compact('shippingAddress', 'cartItems', 'total'));
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
    public function applyDiscount(Request $request)
    {
        $code = $request->input('coupon_code');
        // Kiểm tra code hợp lệ, ví dụ:
        if ($code === 'GIAMGIA10') {
            return response()->json([
                'valid' => true,
                'discountAmount' => 100000, // số tiền giảm
            ]);
        }

        return response()->json([
            'valid' => false,
            'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.',
        ]);
    }

    public function placeOrder(Request $request)
    {
        $selected = $request->input('selected', []);
        if (empty($selected)) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào được chọn.');
        }

        DB::beginTransaction();

        try {
            $userId = Auth::check() ? Auth::id() : null;
            $coupon = session('coupon');
            $discountId = $coupon['id_discount'] ?? null;

            $cartItems = \App\Models\Cart::where('id_user', $userId)
                ->whereIn('id_cart', $selected)
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
            Cart::where('id_user', $userId)->whereIn('id_cart', $selected)->delete();

            DB::commit();

            // Gửi email xác nhận
            $user = Auth::user() ?? 1;
            if ($user && $user->email) {
                Mail::to($user->email)->send(new OrderConfirmationMail([
                    'total_amount' => $request->tong_thanhtoan
                ], $cartItems));
            }


            // Xóa session
            session()->forget(['cart', 'coupon']);

            return redirect()->route('orders.success')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đặt hàng thất bại: ' . $e->getMessage());
        }
    }
}
