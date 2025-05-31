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
use App\Http\Controllers\CheckoutController;
use Illuminate\Auth\Events\Login;



//index hiển thị sản phẩm nổi bật
use App\Http\Controllers\CrudVoucherController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StatisticalController;

use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingAddressController;
// Route::get('/', function() {
//     return redirect('index');
// });
// Route::get('/admin/users', [LoginController::class, 'index'])->name('admin.users.index');

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

// Route::post('/review',[ReviewController::class, 'review'])->name('review');
// Route::post('/review',[ReviewController::class, 'displayReview'])->name('review');

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
//
Route::get('search', [CrudProductController::class, 'search'])->name('product.search');
Route::get('/product/{id}/variant', [CrudProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/comments', [CrudProductController::class, 'allComments'])->name('comment');


// Danh mục
Route::get('danhmuc/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

// Review
Route::get('/review/{id}', [ReviewController::class, 'displayReview'])->name('review.display');
Route::post('/review/{id}', [ReviewController::class, 'review'])->middleware('auth')->name('review');


// Giỏ hàng
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Admin
Route::prefix('admin')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [CrudUserController::class, 'admin'])->name('admin');
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');

    Route::prefix('managerreview')->group(function () {
        Route::get('/', [ReviewController::class, 'displayManagerReview'])->name('managerreview');
        Route::post('/approve/{id}', [ReviewController::class, 'approve'])->name('approve');
        Route::post('/hide/{id}', [ReviewController::class, 'hide'])->name('hide');
        Route::delete('/delete/{id}', [ReviewController::class, 'delete'])->name('delete');
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
    Route::prefix('voucher')->group(function () {
        Route::get('/', [CrudVoucherController::class, 'getList'])->name('voucher.list');
        Route::get('add', [CrudVoucherController::class, 'add'])->name('voucher.add');
        Route::post('add', [CrudVoucherController::class, 'postVoucher'])->name('voucher.postVoucher');
        Route::get('update/{id}', [CrudVoucherController::class, 'update'])->name('voucher.update');
        Route::post('update', [CrudVoucherController::class, 'postUpdate'])->name('voucher.postUpdate');
        Route::get('delete/{id}', [CrudVoucherController::class, 'delete'])->name('voucher.delete');
    });
    // Voucher
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.list');
        Route::get('add', [CategoryController::class, 'create'])->name('category.add');
        Route::post('add', [CategoryController::class, 'store'])->name('category.store');
        Route::get('update/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('update', [CategoryController::class, 'postEdit'])->name('category.postEdit');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });
    Route::prefix('promotion')->group(function () {
        Route::get('/', [PromotionController::class, 'index'])->name('promotion.list');
        Route::get('add', [PromotionController::class, 'add'])->name('promotion.add');
        Route::post('postPromotion', [PromotionController::class, 'postPromotion'])->name('promotion.postPromotion');
    
        Route::get('/delete/{id}', [PromotionController::class, 'delete'])->name('promotion.delete');
        Route::get('update/{id}', [PromotionController::class, 'update'])->name('promotion.update');
        Route::post('update', [PromotionController::class, 'postUpdate'])->name('promotion.postUpdate');
    
        Route::get('{id_promotion}/product/{id_product}', [PromotionController::class, 'deleteProduct'])->name('promotionProduct.delete');
        Route::get('{id_promotion}', [PromotionController::class, 'addForm'])->name('promotionProduct.addForm');
        Route::post('product/add', [PromotionController::class, 'postAdd'])->name('promotionProduct.postAdd');
        Route::get('{id}/products', [PromotionController::class, 'listProducts'])->name('promotion.products');
    });
   

    // Đơn hàng
    Route::prefix('order')->group(function () {
        // Route::get('/', [OrderAdminController::class, 'orderAdmin'])->name('orders.order_admin');
        Route::get('/', [OrderAdminController::class, 'processInvoices'])->name('orders.order_admin');
        Route::post('/confirm/{id}', [OrderAdminController::class, 'confirm'])->name('order_confirm');
        // Route::get('/cancelled', [OrderAdminController::class, 'orderCancelled'])->name('orders.order_cancelled');
        Route::get('/cancelled', [OrderAdminController::class, 'cancellInvoice'])->name('orders.order_cancelled');
        Route::delete('/{invoice_id}/delete', [OrderAdminController::class, 'deleteInvoiceCancel'])->name('deleteInvoice');
    });

    // Thống kê
    Route::prefix('statistic')->group(function () {
        Route::get('money', [StatisticalController::class, 'statisticMoney'])->name('statistic.statistic_money');
        Route::post('money', [StatisticalController::class, 'totalRevenua']);

        // Route::get('quantity', [StatisticalController::class, 'statisticQuantity'])->name('statistic.statistic_quantity');
        Route::get('quantity', [StatisticalController::class, 'caculateQuantity'])->name('statistic.statistic_quantity');

        // Route::get('product', [StatisticalController::class, 'statisticProduct'])->name('statistic.statistic_product');
        Route::get('product', [StatisticalController::class, 'caculateRating'])->name('statistic.statistic_product');
    });

    // Báo cáo
    Route::prefix('report')->group(function () {
        // Route::get('customer', [ReportController::class, 'reportCustomer'])->name('report.report_customer');
        Route::get('customer', [ReportController::class, 'topCustomer'])->name('report.report_customer');

        // Route::get('product', [ReportController::class, 'reportProduct'])->name('report.report_product');
        Route::get('product', [ReportController::class, 'topProductBest'])->name('report.report_product');
    });
});
///


Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Đăng ký + OTP
    Route::get('/register', [AuthOtpController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthOtpController::class, 'register'])->name('register.submit');
    Route::get('/send-otp', [AuthOtpController::class, 'showSendOtpForm'])->name('send.otp.form');
    Route::post('/send-otp', [AuthOtpController::class, 'sendOtp'])->name('send.otp');
    Route::get('/verify-otp', [AuthOtpController::class, 'showOtpForm'])->name('verify.otp.form');
    Route::post('/verify-otp', [AuthOtpController::class, 'verify'])->name('verify.otp.submit');

    // Trang chủ sản phẩm
    Route::get('/index', [CrudProductController::class, 'index'])->name('index');

    // Admin routes
    Route::post('/admin/users/{id}/lock', [AdminController::class, 'lockUser'])->name('admin.users.lock');
    Route::post('/admin/users/{id}/unlock', [AdminController::class, 'unlockUser'])->name('admin.users.unlock');
});

Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->group(function () {
    // Route::get('/admin', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.users.index');
    // Route::get('admin', [CrudUserController::class, 'admin'])->name('admin');
    Route::get('/', [CrudUserController::class, 'admin'])->name('admin');
});

// Nhóm route dành cho người dùng đã đăng nhập (không cần là admin)
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/transaction-history', [InvoiceController::class, 'index'])->name('transaction.history');
    // Thêm các route người dùng thường khác vào đây
});

// Route để hiển thị chi tiết đơn hàng
Route::get('/hoa-don/{id}', [InvoiceController::class, 'show']);


// Route để hiển thị chi tiết đơn hàng
Route::get('/hoa-don/{id}', [InvoiceController::class, 'show']);


Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


// Các route cho quản lý địa chỉ giao hàng
Route::middleware('auth')->group(function () {
    Route::prefix('shipping-addresses')->name('shipping_addresses.')->group(function () {
        Route::get('/', [ShippingAddressController::class, 'index'])->name('index'); // Danh sách địa chỉ
        Route::get('/create', [ShippingAddressController::class, 'create'])->name('create'); // Form thêm địa chỉ
        Route::post('/', [ShippingAddressController::class, 'store'])->name('store'); // Xử lý thêm địa chỉ
        Route::get('/{shippingAddress}/edit', [ShippingAddressController::class, 'edit'])->name('edit'); // Form sửa địa chỉ
        Route::put('/{shippingAddress}', [ShippingAddressController::class, 'update'])->name('update'); // Xử lý sửa địa chỉ
        Route::delete('/{shippingAddress}', [ShippingAddressController::class, 'destroy'])->name('destroy'); // Xử lý xóa địa chỉ
    });
});

Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/shipping/save', [CartController::class, 'saveShipping'])->name('shipping.save');
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');

//middleware('auth') kiểm tra xem có đăng nhập hay chưa
//Route::post('/checkout', [CartController::class, 'showCheckout'])->middleware('auth')->name('checkout.show');
//Route::post('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
// Route::post('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'show'])->name('checkout.show');

Route::post('/checkout/clear-session', [CheckoutController::class, 'clearSession'])->name('checkout.clear_session');
//Xử lý voucher
Route::post('/checkout/apply-discount', [CheckoutController::class, 'applyDiscount'])->name('checkout.applyDiscount');
// đặt hàng
Route::post('/checkout/placeOrder', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');



// Hủy đơn (PUT hoặc PATCH)
Route::put('/invoices/{id}/cancel', [InvoiceController::class, 'cancel'])->name('invoice.cancel');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');






Route::post('/profile/password/change', [CrudUserController::class, 'changePassword'])->name('profile.password.change');
Route::get('/profile/password/change', [CrudUserController::class, 'showChangePasswordForm'])->name('profile.password.index');
