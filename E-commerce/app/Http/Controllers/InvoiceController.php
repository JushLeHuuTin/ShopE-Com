<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
     public function placeOrder(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống.');
        }

        DB::beginTransaction();

        try {
            $userId = Auth::check() ? Auth::id() : null;
            $coupon = session('coupon');
            $discountId = $coupon['id_discount'] ?? null;

            // Tạo hóa đơn
            $invoice = DB::table('invoices')->insertGetId([
                'id_user' => $userId,
                'id_discount' => $discountId,
                'total_amount' => $request->tong_thanhtoan,
                'invoice_date' => Carbon::now(),
                'status' => 'pending',
                'payment_method' => $request->payment_method ?? 'COD',
            ]);

            // Ghi chi tiết hóa đơn
            foreach ($cart as $item) {
                DB::table('invoices_detail')->insert([
                    'id_invoice' => $invoice,
                    'id_variant' => $item['id_variant'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'], // giá tại thời điểm đặt hàng
                ]);
            }

            DB::commit();

            // Xóa giỏ hàng & mã giảm giá sau khi đặt
            session()->forget('cart');
            session()->forget('coupon');

            return redirect()->route('orders.success')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng: ' . $e->getMessage());
        }
    }

    // Hiển thị danh sách hóa đơn của người dùng đang đăng nhập
    public function index()
    {
        $userId = Auth::id(); //Auth::id(); // Lấy ID user hiện tại

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        }

        $invoices = Invoice::with('details.variant.product')
            ->where('id_user', $userId)
            ->orderByDesc('invoice_date')
            ->get();

        return view('invoices', compact('invoices'));
    }

    // Hiển thị chi tiết một hóa đơn cụ thể
    public function show($id)
    {
        $invoice = Invoice::with(['details.variant.product', 'discount'])
            ->where('id_invoice', $id)
            // ->where('id_user', Auth::id())
            ->where('id_user', 1)
            ->firstOrFail();

        return view('invoice.show', compact('invoice'));
    }

    //Hủy đơn hàng
    public function cancel($id)
    {
        $invoice = Invoice::where('id_invoice', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Chỉ cho hủy khi đang ở trạng thái pending
        if ($invoice->status !== 'pending') {
            return back()->with('error', 'Không thể hủy đơn này.');
        }

        $invoice->status = 'cancelled';
        $invoice->cancellation_reason = 'Hủy bởi khách hàng';
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Đơn hàng đã được hủy.');

    }
}
