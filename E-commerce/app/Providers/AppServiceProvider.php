<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
        View::composer('*', function ($view) {
            $userId = Auth::id();
            $sessionId = session()->getId();

            $query = Cart::query();

            if ($userId) {
                $query->where('id_user', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }

            $totalItems = $query->count(); // hoặc ->sum('quantity') nếu muốn tổng số lượng

            $view->with('cartQuantity', $totalItems);
        });
    }
}
