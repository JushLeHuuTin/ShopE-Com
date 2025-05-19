<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function orderAdmin()
    {
        return view('orders.order_admin');
    }
    public function orderCancelled()
    {
        return view('orders.order_cancelled');
    }
    public function orderProcess()
    {
        return view('orders.order_process');
    }
    
    //Tinh doanh thu trong khoang thoi gian da chon
    public function totalRevenua(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if (!$startDate || !$endDate) {
             return redirect()->back()->with('error', 'Vui lòng chọn ngày bắt đầu và kết thúc.');
        }

        $invoices = Invoice::where('status', 'completed')->
        whereBetween('created_at', [$startDate, $endDate])->get();

        $totalRevenue = $invoices->sum('total_amount');
        $totalInvoice = $invoices->count();
        
        return view('statistic.statistic_money', compact('startDate', 'endDate', 'totalRevenue', 'totalInvoice'));
    }
}
