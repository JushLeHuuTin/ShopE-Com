<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
        session(['id_user' => 5]);
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
