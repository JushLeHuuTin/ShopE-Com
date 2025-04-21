<?php

namespace App\Http\Controllers;
use App\Models\Product;


use Illuminate\Http\Request;

class CrudProductController extends Controller
{
    // public function index()
    // {
    //     // $featuredProducts = Product::where('is_featured', 1)->get();
    //     // return view('welcome', compact('featuredProducts'));
    // }
    public function index()
    {
        $featuredProducts = Product::with('defaultVariant')
        ->where('is_featured', 1)
        ->take(8)
        ->get();
        return view('index', compact('featuredProducts'));
    }


}
