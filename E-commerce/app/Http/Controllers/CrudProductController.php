<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Product_Variant;
// use App\Models\Product_Variants;
use Illuminate\Http\Request;

class CrudProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('defaultVariant')
        ->where('is_featured', 1)
        ->get();
        return view('index', compact('featuredProducts'));
    }
    public function productDetail($id)
    {
        $product = Product::with('Product_Variants')->findOrFail($id);
        return view('productdetail', compact('product'));
    }
    public function show(Request $request,$id )
    {
        $product = Product::with('Product_Variants')->findOrFail($id);
        // dd($id);
        $variant = null;
        if ($request->has('variant_id')) {
            $variant = Product_Variant::find($request->variant_id);
        }
    
        return view('productDetail', compact('product', 'variant'));
    }
}
