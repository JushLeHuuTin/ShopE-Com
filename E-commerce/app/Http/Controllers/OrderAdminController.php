<?php

namespace App\Http\Controllers;

use App\Models\Orders;
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
    public function reportCustomer() 
    {
        return view('report.report_customer');
    }
    public function reportProduct() 
    {
        return view('report.report_product');
    }
}
