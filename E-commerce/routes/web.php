<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\voucher;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Login;

Route::get('/', function() {
    return redirect('index');
});
Route::get('/admin/users', [LoginController::class, 'index'])->name('admin.users.index');

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
Route::get('/product/variant/{id}', [CrudProductController::class, 'show'])->name('product.show');

//admin
Route::get('admin/product/add', [CrudProductController::class, 'add'])->name('product.add');
Route::post('postProduct', [CrudProductController::class, 'postProduct'])->name('product.postProduct');
Route::get('admin/product', [CrudProductController::class, 'list'])->name('product.list');
// Route::get('admin', [CrudProductController::class, 'update'])->name('product.update');
Route::get('deleted', [CrudProductController::class, 'delete'])->name('product.deleted');

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');


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

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

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






