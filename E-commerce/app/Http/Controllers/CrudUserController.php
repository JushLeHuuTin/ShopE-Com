<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
<<<<<<< HEAD
        return view('index');   
=======
        $featuredProducts = Product::where('is_featured', 1)->get();
        return view('index', compact('featuredProducts'));
>>>>>>> origin/tin/f3/delete-product
    }
    public function admin()
    {
        // if(Auth::check()){\
            return view('admin.index');
        // }
        // return redirect()->route('admin.login');
    }
}
