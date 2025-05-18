<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Carbon\Carbon; // Đừng quên import Carbon

class StatisticalController extends Controller
{
    public function statisticMoney()
    {
        return view('statistic.statistic_money');
    }
    public function statisticProduct()
    {
        return view('statistic.statistic_product');
    }
    public function statisticQuantity()
    {
        return view('statistic.statistic_quantity');
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
