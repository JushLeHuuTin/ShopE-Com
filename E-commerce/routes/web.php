<?php

use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StatisticalController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('users.authUser');

Route::get('/', function() {
    return redirect('index');
});
Route::get('index', [CrudUserController::class, 'index'])->name('index');

Route::get('/review',[ReviewController::class, 'review'])->name('review.review');
Route::get('/review',[ReviewController::class, 'displayReview'])->name('review');

Route::get('/managerreview', [ReviewController::class, 'displayManagerReview'])->name('managerreview');

Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');

//Orders
Route::get('/test', function() {
    return route('orders.order_admin');
});

Route::get('/admin/order', [OrderAdminController::class, 'orderAdmin'])->name('orders.order_admin');
Route::get('/admin/order/cancelled', [OrderAdminController::class, 'orderCancelled'])->name('orders.order_cancelled');
Route::get('/admin/order/process', [OrderAdminController::class, 'orderProcess'])->name('orders.order_process');

//Statistic
Route::get('/admin/statistic/money', [StatisticalController::class, 'statisticMoney'])->name('statistic.statistic_money');
Route::post('/admin/statistic/money', [StatisticalController::class, 'totalRevenua'])->name('statistic.statistic_money');

Route::get('/admin/statistic/quantity', [StatisticalController::class, 'statisticQuantity'])->name('statistic.statistic_quantity');
Route::get('/admin/statistic/quantity', [StatisticalController::class, 'caculateQuantity'])->name('statistic.statistic_quantity');

Route::get('/admin/statistic/product', [StatisticalController::class, 'statisticProduct'])->name('statistic.statistic_product');
Route::get('/admin/statistic/product', [StatisticalController::class, 'caculateRating'])->name('statistic.statistic_product');

//Report
Route::get('/admin/report/customer', [ReportController::class, 'reportCustomer'])->name('report.report_customer');
Route::get('/admin/report/customer', [ReportController::class, 'topCustomer'])->name('report.report_customer');

Route::get('/admin/report/product', [ReportController::class, 'reportProduct'])->name('report.report_product'); 
Route::get('/admin/report/product', [ReportController::class, 'topProductBest'])->name('report.report_product'); 