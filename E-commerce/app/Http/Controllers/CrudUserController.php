<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
    
}
