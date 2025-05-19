<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Review;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
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

        $invoices = Invoice::where('status', 'completed')->whereBetween('created_at', [$startDate, $endDate])->get();

        $totalRevenue = $invoices->sum('total_amount');
        $totalInvoice = $invoices->count();

        return view('statistic.statistic_money', compact('startDate', 'endDate', 'totalRevenue', 'totalInvoice'));
    }

    //Thong ke so luong san pham trong kho
    //Thong ke san pham co danh gia tot
    public function caculateRating()
    {
        $topProducts = Review::select(
            'products.id_product as id_product',
            'products.name as product_name',
            'products.image_url as product_image_url',
            'product_variants.price as product_price',
            DB::raw('AVG(reviews.rating) as average_rating'),
            DB::raw('COUNT(reviews.id_review) as total_review')
        )
            ->join('products', 'reviews.id_product', '=', 'products.id_product')
            ->join('product_variants', 'products.id_product', '=', 'product_variants.id_product')
            ->groupBy(
                'products.id_product',
                'products.name',
                'products.image_url',
                'product_variants.price'
            )
            ->orderByDesc('average_rating')
            ->limit(10)
            ->get();

        return view('statistic.statistic_product', compact('topProducts'));
    }
}
