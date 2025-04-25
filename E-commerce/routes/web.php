<?php

use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

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

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');