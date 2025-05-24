<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\CrudVoucherController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\voucher;
use App\Http\Controllers\ReviewController;
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

//admin
Route::get('admin/product/add', [CrudProductController::class, 'add'])->name('product.add');
Route::post('postProduct', [CrudProductController::class, 'postProduct'])->name('product.postProduct');
Route::get('admin/product', [CrudProductController::class, 'getProduct'])->name('product.list');
// Route::get('admin', [CrudProductController::class, 'update'])->name('product.update');
Route::get('admin/product/delete/{id}', [CrudProductController::class, 'delete'])->name('product.delete');
Route::get('admin/product/deleted', [CrudProductController::class, 'deleted'])->name('product.deleted');


Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('admin', [CrudUserController::class, 'admin'])->name('admin');



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
Route::post('admin/promotion/update', [PromotionController::class, 'postUpdate'])->name('promotion.postUpdate');

Route::get('admin/promotion/{id_promotion}/product/{id_product}', [PromotionController::class, 'deleteProduct'])->name('promotionProduct.delete');  
Route::get('admin/promotion/{id_promotion}', [PromotionController::class, 'addForm'])->name('promotionProduct.addForm');  
Route::post('admin/promotion/product/addadd', [PromotionController::class, 'postAdd'])->name('promotionProduct.postAdd');  
Route::get('admin/promotion/{id}/products', [PromotionController::class, 'listProducts'])->name('promotion.products');

Route::get('review',[ReviewController::class, 'displayReview'])->name('review');
Route::post('/review',[ReviewController::class, 'review'])->name('review.review');

Route::get('managerreview', [ReviewController::class, 'displayManagerReview'])->name('review.managerreview');

Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');