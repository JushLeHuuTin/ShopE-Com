<?php

use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\voucher;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
Route::get('index', [CrudUserController::class, 'index'])->name('index');

Route::get('index', function () {
    // Lấy các sản phẩm nổi bật (is_featured = 1)
    $featuredProducts = Product::where('is_featured', 1)->get();
    return view('index', compact('featuredProducts'));
}); 
Route::get('admin', [CrudUserController::class, 'admin'])->name('admin');
Route::get('admin', function () {
    // Lấy các mã giảm giágiá
    $vouchers = Voucher::get();
    return view('admin', compact('vouchers'));
}); 