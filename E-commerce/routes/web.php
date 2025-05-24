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
use App\Http\Controllers\CrudVoucherController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StatisticalController;

// Route::get('/', function() {
//     return redirect('index');
// });
// //index hiển thị sản phẩm nổi bật
// Route::get('index', [CrudProductController::class, 'index'])->name('index');
// //login hiển thị trang login
// Route::get('login', [CrudUserController::class, 'login'])->name('login');
// //xử lí login
// Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
// //register hiển thị trang register
// Route::get('register', [CrudUserController::class, 'register'])->name('register');
// //detail hiển thị trang chi tiết sản phẩm
// Route::get('/product/{id}', [CrudProductController::class, 'productDetail'])->name('product.detail');
// //reload thuộc tính theo id_variant
// Route::get('/product/{id}/varariant', [CrudProductController::class, 'show'])->name('product.show');

// //category
// Route::get('danhmuc/{category:slug}/', [CategoryController::class, 'show'])->name('category.show');

Route::post('/review',[ReviewController::class, 'review'])->name('review');
Route::get('/review',[ReviewController::class, 'displayReview'])->name('review');

// Route::get('/managerreview', [ReviewController::class, 'displayManagerReview'])->name('managerreview');

// Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('approve');
// Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('hide');
// Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('delete');

// //Orders
// Route::get('/admin/order', [OrderAdminController::class, 'orderAdmin'])->name('orders.order_admin');
// Route::get('/admin/order', [OrderAdminController::class, 'processInvoices'])->name('orders.order_admin');

// Route::get('/admin/order/cancelled', [OrderAdminController::class, 'orderCancelled'])->name('orders.order_cancelled');
// Route::get('/admin/order/cancelled', [OrderAdminController::class, 'cancellInvoice'])->name('orders.order_cancelled');
// Route::delete('/admin/order/{invoice_id}/delete', [OrderAdminController::class, 'deleteInvoiceCancel'])->name('deleteInvoice');


// //Statistic
Route::get('/admin/statistic/money', [StatisticalController::class, 'statisticMoney'])->name('statistic.statistic_money');
Route::post('/admin/statistic/money', [StatisticalController::class, 'totalRevenua'])->name('statistic.statistic_money');

// Route::get('/admin/statistic/quantity', [StatisticalController::class, 'statisticQuantity'])->name('statistic.statistic_quantity');
// Route::get('/admin/statistic/quantity', [StatisticalController::class, 'caculateQuantity'])->name('statistic.statistic_quantity');

// Route::get('/admin/statistic/product', [StatisticalController::class, 'statisticProduct'])->name('statistic.statistic_product');
// Route::get('/admin/statistic/product', [StatisticalController::class, 'caculateRating'])->name('statistic.statistic_product');

<<<<<<< HEAD
Route::get('/admin/report/product', [ReportController::class, 'reportProduct'])->name('report.report_product'); 
=======
// Route::get('managerreview', [ReviewController::class, 'displayManagerReview'])->name('review.managerreview');

// Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
// Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
// Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');

// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
// Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// //Report
// Route::get('/admin/report/customer', [ReportController::class, 'reportCustomer'])->name('report.report_customer');
// Route::get('/admin/report/customer', [ReportController::class, 'topCustomer'])->name('report.report_customer');

// Route::get('/admin/report/product', [ReportController::class, 'reportProduct'])->name('report.report_product'); 
// Route::get('/admin/report/product', [ReportController::class, 'topProductBest'])->name('report.report_product'); 



// ////
// //index hiển thị sản phẩm nổi bật
// Route::get('index', [CrudProductController::class, 'index'])->name('index');
// //login hiển thị trang login
// Route::get('login', [CrudUserController::class, 'login'])->name('login');
// //xử lí login
// Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
// // Route::get('index', [CrudUserController::class, 'index'])->name('index');
// // Route::get('cart', [CrudUserController::class, 'cart'])->name('cart');



// //register hiển thị trang register
// Route::get('register', [CrudUserController::class, 'register'])->name('register');
// //detail hiển thị trang chi tiết sản phẩm
// Route::get('/product/{id}', [CrudProductController::class, 'productDetail'])->name('product.detail');
// //reload thuộc tính theo id_variant
// Route::get('/product/{id}/varariant', [CrudProductController::class, 'show'])->name('product.show');

// //admin
// Route::get('admin/product/add', [CrudProductController::class, 'add'])->name('product.add');
// Route::post('postProduct', [CrudProductController::class, 'postProduct'])->name('product.postProduct');
// Route::get('admin/product', [CrudProductController::class, 'getProduct'])->name('product.list');
// //update product
// Route::get('admin/product/update/{id}', [CrudProductController::class, 'edit'])->name('product.edit');
// Route::post('admin/product/update', [CrudProductController::class, 'postEdit'])->name('product.postEdit');
// // Route::get('admin', [CrudProductController::class, 'update'])->name('product.update');
// Route::get('admin/product/delete/{id}', [CrudProductController::class, 'delete'])->name('product.delete');
// Route::get('admin/product/deleted', [CrudProductController::class, 'deleted'])->name('product.deleted');

// Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

// //category
// Route::get('danhmuc/{category:slug}/', [CategoryController::class, 'show'])->name('category.show');


// Route::get('admin', [CrudUserController::class, 'admin'])->name('admin');
// Route::get('admin/voucher', function () {
//     // Lấy các mã giảm giá
//     $vouchers = Voucher::get();
//     return view('admin.voucher', compact('vouchers'));
// }); 
// Route::get('review',[ReviewController::class, 'displayReview'])->name('review');
// Route::post('/review',[ReviewController::class, 'review'])->name('review.review');

// Route::get('managerreview', [ReviewController::class, 'displayManagerReview'])->name('review.managerreview');

// Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
// Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
// Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');


// Trang chủ
Route::redirect('/', 'index');
Route::get('index', [CrudProductController::class, 'index'])->name('index');

// Auth
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
Route::get('register', [CrudUserController::class, 'register'])->name('register');

// Sản phẩm
Route::get('/product/{id}', [CrudProductController::class, 'productDetail'])->name('product.detail');
Route::get('/product/{id}/variant', [CrudProductController::class, 'show'])->name('product.show');

// Danh mục
Route::get('danhmuc/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

// Review
Route::get('/review', [ReviewController::class, 'displayReview'])->name('review');
Route::post('/review', [ReviewController::class, 'review'])->name('review');



// Giỏ hàng
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [CrudUserController::class, 'admin'])->name('admin');
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');

    Route::prefix('managerreview')->group(function () {
        Route::get('/', [ReviewController::class, 'displayManagerReview'])->name('managerreview');
        Route::post('{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
        Route::post('{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
        Route::delete('{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');
    });
    // Product
    Route::prefix('product')->group(function () {
        Route::get('/', [CrudProductController::class, 'getProduct'])->name('product.list');
        Route::get('add', [CrudProductController::class, 'add'])->name('product.add');
        Route::post('add', [CrudProductController::class, 'postProduct'])->name('product.postProduct');
        Route::get('update/{id}', [CrudProductController::class, 'edit'])->name('product.edit');
        Route::post('update', [CrudProductController::class, 'postEdit'])->name('product.postEdit');
        Route::get('delete/{id}', [CrudProductController::class, 'delete'])->name('product.delete');
        Route::get('deleted', [CrudProductController::class, 'deleted'])->name('product.deleted');
    });

    // Voucher
    Route::get('voucher', function () {
        $vouchers = App\Models\Voucher::get();
        return view('admin.voucher', compact('vouchers'));
    })->name('admin.voucher');

    // Đơn hàng
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderAdminController::class, 'orderAdmin'])->name('orders.order_admin');
        Route::get('/', [OrderAdminController::class, 'processInvoices'])->name('orders.order_admin');
        Route::get('/cancelled', [OrderAdminController::class, 'orderCancelled'])->name('orders.order_cancelled');
        Route::get('/cancelled', [OrderAdminController::class, 'cancellInvoice'])->name('orders.order_cancelled');
        Route::delete('/{invoice_id}/delete', [OrderAdminController::class, 'deleteInvoiceCancel'])->name('deleteInvoice');
    });

    // Thống kê
    Route::prefix('statistic')->group(function () {
        Route::get('money', [StatisticalController::class, 'statisticMoney'])->name('statistic.statistic_money');
        Route::post('money', [StatisticalController::class, 'totalRevenua']);

        Route::get('quantity', [StatisticalController::class, 'statisticQuantity'])->name('statistic.statistic_quantity');
        Route::get('quantity', [StatisticalController::class, 'caculateQuantity'])->name('statistic.statistic_quantity');

        Route::get('product', [StatisticalController::class, 'statisticProduct'])->name('statistic.statistic_product');
        Route::get('product', [StatisticalController::class, 'caculateRating'])->name('statistic.statistic_product');
    });

    // Báo cáo
    Route::prefix('report')->group(function () {
        Route::get('customer', [ReportController::class, 'reportCustomer'])->name('report.report_customer');
    Route::get('customer', [ReportController::class, 'topCustomer'])->name('report.report_customer');
    
        Route::get('product', [ReportController::class, 'reportProduct'])->name('report.report_product');
        Route::get('product', [ReportController::class, 'topProductBest'])->name('report.report_product');
    });


    //

    Route::get('admin/voucher/delete/{id}', [CrudVoucherController::class, 'delete'])->name('voucher.delete');
    Route::get('admin/voucher/add', [CrudVoucherController::class, 'add'])->name('voucher.add');
    Route::get('admin/voucher', [CrudVoucherController::class, 'getList'])->name('voucher.list');
    Route::post('admin/postVoucher', [CrudVoucherController::class, 'postVoucher'])->name('voucher.postVoucher');
    Route::get('admin/voucher/update/{id}', [CrudVoucherController::class, 'update'])->name('voucher.update');
    Route::post('admin/voucher/update/', [CrudVoucherController::class, 'postUpdate'])->name('voucher.postUpdate');


    Route::get('admin/promotion/add', [PromotionController::class, 'add'])->name('promotion.add');
    Route::get('admin/promotion', [PromotionController::class, 'index'])->name('promotion.list');
    Route::post('admin/postPromotion', [PromotionController::class, 'postPromotion'])->name('promotion.postPromotion');

    Route::get('admin/promotion/delete/{id}', [PromotionController::class, 'delete'])->name('promotion.delete');
    Route::get('admin/promotion/update/{id}', [PromotionController::class, 'update'])->name('promotion.update');
    // Route::post('admin/promotion/update/', [PromotionController::class, 'postUpdate'])->name('promotion.postUpdate');

});
>>>>>>> trieu/f10/dislay-review/comment
