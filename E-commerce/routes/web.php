<?php

use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', [CrudProductController::class, 'index'])->name('index');

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
//register
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::get('register', [CrudUserController::class, 'register'])->name('register');
// Route::get('productDetail', [CrudProductController::class, 'productDetail'])->name('productDetail');
Route::get('/product/{id}', [CrudProductController::class, 'productDetail'])->name('product.detail');

//show price by size
Route::get('/product/variant/{id}', [CrudProductController::class, 'show'])->name('product.show');

// Route::get('index', function () {
//     // Lấy các sản phẩm nổi bật (is_featured = 1)
//     $featuredProducts = Product::where('is_featured', 1)->get();
//     return view('index', compact('featuredProducts'));
// });
// Route::get('login', [CrudUserController::class, 'login'])->name('login');

Route::get('/', function() {
    return redirect('index');
});
Route::get('index', [CrudUserController::class, 'index'])->name('index');

Route::get('review',[ReviewController::class, 'displayReview'])->name('review');
Route::post('/review',[ReviewController::class, 'review'])->name('review.review');

Route::get('managerreview', [ReviewController::class, 'displayManagerReview'])->name('review.managerreview');

Route::post('/managerreview/{id}/approve', [ReviewController::class, 'approve'])->name('review.approve');
Route::post('/managerreview/{id}/hide', [ReviewController::class, 'hide'])->name('review.hide');
Route::delete('/managerreview/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');

