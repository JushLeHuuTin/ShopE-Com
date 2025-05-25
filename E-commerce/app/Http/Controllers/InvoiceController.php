<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // Đảm bảo rằng chỉ người dùng đã đăng nhập mới có thể truy cập các route này
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = auth()->user();

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem lịch sử giao dịch.');
        }

        // Lấy danh sách hóa đơn của người dùng
        $invoices = Invoice::where('id_user', $user->id_user)->paginate(10); // Bạn có thể điều chỉnh số lượng theo yêu cầu

        // Trả về view và truyền dữ liệu hóa đơn
        return view('invoice.index', compact('invoices' , 'user'));
    }

    public function show($id)
    {
        // Hiển thị chi tiết đơn hàng
        $invoice = Invoice::findOrFail($id);

        // Trả về view chi tiết hóa đơn
        return view('invoice.show', compact('invoice'));
    }
}
