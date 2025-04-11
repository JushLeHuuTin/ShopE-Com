<?php

use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
Route::get('index', [CrudUserController::class, 'index'])->name('index');
Route::get('cart', [CrudUserController::class, 'cart'])->name('cart');


Route::get('index', function () {
    // Lấy các sản phẩm nổi bật (is_featured = 1)
    $featuredProducts = Product::where('is_featured', 1)->get();
    return view('index', compact('featuredProducts'));
});