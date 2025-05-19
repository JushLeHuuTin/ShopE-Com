<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportCustomer()
    {
        return view('report.report_customer');
    }
    public function reportProduct()
    {
        return view('report.report_product');
    }
    public function topCustomer() 
    {
        $topCustomer = Invoice::select(
            'users.username as customer_name',
            'users.email as customer_email',
            'users.phone as customer_phone',
            DB::raw('COUNT(invoices.id_invoice) as total_orders'),
            DB::raw('SUM(invoices.total_amount) as total_amount')
        )
        ->join('users', 'invoices.id_user', '=' , 'users.id_user')
        ->groupBy('invoices.id_user', 'users.username', 'users.email', 'users.phone')
        ->orderByDesc('total_amount')
        ->limit(10)
        ->get();

        return view('report.report_customer', compact('topCustomer'));
    }
}
