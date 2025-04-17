<?php

use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
Route::get('index', [CrudProductController::class, 'index'])->name('index');

// Route::get('index', function () {
//     // Lấy các sản phẩm nổi bật (is_featured = 1)
//     $featuredProducts = Product::where('is_featured', 1)->get();
//     return view('index', compact('featuredProducts'));
// });