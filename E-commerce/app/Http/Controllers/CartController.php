<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product_Variant;
use App\Models\ShippingAddress;
use App\Models\DiscountCode;

class CartController extends Controller
{

    public function index()
    {
        $userId = Auth::id() ?? 1;
        // Kiểm tra xem người dùng đã đăng nhập chưa
        // if (!$userId) {
        //     return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        // }

        $carts = Cart::with(['variant.product'])
            ->where('id_user', $userId)
            ->orderBy('added_at', 'desc')
            ->paginate(15);

        // Lấy địa chỉ mặc định nếu có
        $shipping = ShippingAddress::where('id_user', $userId)
            // ->where('default_address', 1)
            ->first();

        // dd($shipping);

        return view('cart', compact('carts', 'shipping'));
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

        // // Xác định người dùng hoặc session
        // $userId = Auth::check() ? Auth::id() : null;


        $userId = Auth::id() ?? 1;
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
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    public function saveShipping(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        // Cập nhật địa chỉ mặc định thành 0
        ShippingAddress::where('id_user', $userId)->update(['default_address' => 0]);

        // Cập nhật hoặc tạo mới địa chỉ mặc định
        ShippingAddress::updateOrCreate(
            ['id_user' => $userId],
            [
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'default_address' => 1
            ]
        );

        return redirect()->back()->with('success', 'Thông tin vận chuyển đã được lưu.');
    }


    //giảm giá
    public function applyDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $code = strtoupper($request->code);
        $discount = DiscountCode::where('code', $code)->first();

        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Mã không tồn tại.']);
        }

        if ($discount->expiration_date < now()) {
            return response()->json(['success' => false, 'message' => 'Mã đã hết hạn.']);
        }

        if ($discount->max_uses <= 0) {
            return response()->json(['success' => false, 'message' => 'Mã đã được dùng hết.']);
        }

        return response()->json([
            'success' => true,
            'discount_value' => $discount->discount_value
        ]);
    }
}
