<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;



use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product_Variant;

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


    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id_cart' => 'required|exists:cart,id_cart',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::find($request->id_cart);
        $cart->quantity = $request->quantity;
        $cart->updated_at = now();
        $cart->save();

        $subtotal = $cart->quantity * $cart->price;

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal, 0, ',', '.'),
        ]);
    }


    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id_variant',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = Product_Variant::findOrFail($request->variant_id);

        // Xác định người dùng hoặc session
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId(); // mã phiên mặc định của Laravel

        // Kiểm tra nếu đã tồn tại variant trong giỏ thì cập nhật số lượng
        $existingCartItem = Cart::where('id_variant', $variant->id_variant)
            ->when($userId, fn($q) => $q->where('id_user', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            Cart::create([
                'id_user'     => $userId,
                'session_id'  => $userId ? null : $sessionId,
                'id_variant'  => $variant->id_variant,
                'quantity'    => $request->quantity,
                'price'       => $variant->price,
                'added_at'    => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }
}
