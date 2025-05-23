<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\voucher;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StatisticalController;

Route::get('/', function() {
    return redirect('index');
});
//index hiển thị sản phẩm nổi bật
Route::get('index', [CrudProductController::class, 'index'])->name('index');
//login hiển thị trang login
Route::get('login', [CrudUserController::class, 'login'])->name('login');
//xử lí login
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
//register hiển thị trang register
Route::get('register', [CrudUserController::class, 'register'])->name('register');
//detail hiển thị trang chi tiết sản phẩm
Route::get('/product/{id}', [CrudProductController::class, 'productDetail'])->name('product.detail');
//reload thuộc tính theo id_variant
Route::get('/product/{id}/varariant', [CrudProductController::class, 'show'])->name('product.show');

//category
Route::get('danhmuc/{category:slug}/', [CategoryController::class, 'show'])->name('category.show');

Route::post('/review',[ReviewController::class, 'review'])->name('review');
Route::post('/review',[ReviewController::class, 'displayReview'])->name('review');

Route::get('/managerreview', [ReviewController::class, 'displayManagerReview'])->name('managerreview');

Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('approve');
Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('hide');
Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('delete');

//Orders
Route::get('/admin/order', [OrderAdminController::class, 'orderAdmin'])->name('orders.order_admin');
Route::get('/admin/order', [OrderAdminController::class, 'processInvoices'])->name('orders.order_admin');

Route::get('/admin/order/cancelled', [OrderAdminController::class, 'orderCancelled'])->name('orders.order_cancelled');
Route::get('/admin/order/cancelled', [OrderAdminController::class, 'cancellInvoice'])->name('orders.order_cancelled');
Route::delete('/admin/order/{invoice_id}/delete', [OrderAdminController::class, 'deleteInvoiceCancel'])->name('deleteInvoice');


//Statistic
Route::get('/admin/statistic/money', [StatisticalController::class, 'statisticMoney'])->name('statistic.statistic_money');
Route::post('/admin/statistic/money', [StatisticalController::class, 'totalRevenua'])->name('statistic.statistic_money');

Route::get('/admin/statistic/quantity', [StatisticalController::class, 'statisticQuantity'])->name('statistic.statistic_quantity');
Route::get('/admin/statistic/quantity', [StatisticalController::class, 'caculateQuantity'])->name('statistic.statistic_quantity');

Route::get('/admin/statistic/product', [StatisticalController::class, 'statisticProduct'])->name('statistic.statistic_product');
Route::get('/admin/statistic/product', [StatisticalController::class, 'caculateRating'])->name('statistic.statistic_product');

Route::get('managerreview', [ReviewController::class, 'displayManagerReview'])->name('review.managerreview');

Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

//Report
Route::get('/admin/report/customer', [ReportController::class, 'reportCustomer'])->name('report.report_customer');
Route::get('/admin/report/customer', [ReportController::class, 'topCustomer'])->name('report.report_customer');

Route::get('/admin/report/product', [ReportController::class, 'reportProduct'])->name('report.report_product'); 
Route::get('/admin/report/product', [ReportController::class, 'topProductBest'])->name('report.report_product'); 



////
//index hiển thị sản phẩm nổi bật
Route::get('index', [CrudProductController::class, 'index'])->name('index');
//login hiển thị trang login
Route::get('login', [CrudUserController::class, 'login'])->name('login');
//xử lí login
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
//register hiển thị trang register
Route::get('register', [CrudUserController::class, 'register'])->name('register');
//detail hiển thị trang chi tiết sản phẩm
Route::get('/product/{id}', [CrudProductController::class, 'productDetail'])->name('product.detail');
//reload thuộc tính theo id_variant
Route::get('/product/{id}/varariant', [CrudProductController::class, 'show'])->name('product.show');

//admin
Route::get('admin/product/add', [CrudProductController::class, 'add'])->name('product.add');
Route::post('postProduct', [CrudProductController::class, 'postProduct'])->name('product.postProduct');
Route::get('admin/product', [CrudProductController::class, 'getProduct'])->name('product.list');
//update product
Route::get('admin/product/update/{id}', [CrudProductController::class, 'edit'])->name('product.edit');
Route::post('admin/product/update', [CrudProductController::class, 'postEdit'])->name('product.postEdit');
// Route::get('admin', [CrudProductController::class, 'update'])->name('product.update');
Route::get('admin/product/delete/{id}', [CrudProductController::class, 'delete'])->name('product.delete');
Route::get('admin/product/deleted', [CrudProductController::class, 'deleted'])->name('product.deleted');

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

//category
Route::get('danhmuc/{category:slug}/', [CategoryController::class, 'show'])->name('category.show');


Route::get('admin', [CrudUserController::class, 'admin'])->name('admin');
Route::get('admin/voucher', function () {
    // Lấy các mã giảm giá
    $vouchers = Voucher::get();
    return view('admin.voucher', compact('vouchers'));
}); 
Route::get('review',[ReviewController::class, 'displayReview'])->name('review');
Route::post('/review',[ReviewController::class, 'review'])->name('review.review');

Route::get('managerreview', [ReviewController::class, 'displayManagerReview'])->name('review.managerreview');

Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');