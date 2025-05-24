<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CrudUserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function index()
    {
        $featuredProducts = Product::where('is_featured', 1)->get();
        return view('index', compact('featuredProducts'));
    }
    public function admin()
    {
        // if(Auth::check()){\
            return view('admin.index');
        // }
        // return redirect()->route('admin.login');
    }
    public function cart()
    {
        return view('cart');
    }
}
