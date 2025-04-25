<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['user', 'product_variants'])
                     ->orderBy('added_at', 'desc')
                     ->paginate(15);
    
        // trả về resources/views/cart.blade.php
        return view('cart', compact('carts'));
    }
    
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Xóa thành công');
    }


}
