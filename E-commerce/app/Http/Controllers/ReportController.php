<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicesDetail;
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
    //Get information top customer 
    public function topCustomer()
    {
        $topCustomer = Invoice::select(
            'users.username as customer_name',
            'users.email as customer_email',
            'users.phone as customer_phone',
            DB::raw('COUNT(invoices.id_invoice) as total_orders'),
            DB::raw('SUM(invoices.total_amount) as total_amount')
        )
            ->join('users', 'invoices.id_user', '=', 'users.id_user')
            ->groupBy('invoices.id_user', 'users.username', 'users.email', 'users.phone')
            ->orderByDesc('total_amount')
            ->limit(10)
            ->get();

        return view('report.report_customer', compact('topCustomer'));
    }
    //Get information product sell well 
    public function topProductBest()
    {
        $topProductBest = InvoicesDetail::select(
            'products.name as product_name',
            'products.image_url as product_image_url',
            'product_variants.price as product_price',
            DB::raw('SUM(invoices_detail.quantity) as total_sold'),
            DB::raw('SUM(invoices_detail.quantity * invoices_detail.price) as total_revenue')
        )
            ->join('product_variants', 'invoices_detail.id_variant', '=', 'product_variants.id_variant')
            ->join('products', 'product_variants.id_product', '=', 'products.id_product')
            ->join('invoices', 'invoices_detail.id_invoice', '=', 'invoices.id_invoice')
            ->where('invoices.status', 'completed')
            ->groupBy('products.id_product', 'products.name', 'products.image_url', 'product_variants.price')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('report.report_product', compact('topProductBest'));
    }
}
