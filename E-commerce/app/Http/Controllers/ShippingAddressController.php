<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShippingAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        // Cần sử dụng id_user để truy vấn
        $addresses = ShippingAddress::where('id_user', $user->id_user)->orderBy('default_address', 'desc')->get();
        return view('shipping_addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('shipping_addresses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Sử dụng các tên cột từ migration
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|digits:10',
            'address' => 'required|string',
            'default_address' => 'nullable|boolean',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên người nhận.',
            'full_name.max' => 'Họ và tên người nhận không được quá 255 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.digits' => 'Số điện thoại phải gồm 10 chữ số.',
            'address.required' => 'Vui lòng nhập địa chỉ chi tiết.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('shipping_addresses.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = Auth::user();
        // Sử dụng id_user
        $address = new ShippingAddress();
        $address->id_user = $user->id_user;
        $address->full_name = $request->input('full_name');
        $address->phone = $request->input('phone');
        $address->address = $request->input('address');
        $address->default_address = $request->input('default_address', 0); // Đặt giá trị mặc định nếu không được cung cấp
        $address->save();

        if ($request->has('default_address') && $request->input('default_address') == 1) {
             // Sử dụng id_user và default_address
             ShippingAddress::where('id_user', $user->id_user)->where('id_address', '!=', $address->id_address)->update(['default_address' => 0]);
             $address->default_address = 1;
             $address->save();
        }



        return redirect()->route('shipping_addresses.index')->with('success', 'Thêm địa chỉ thành công!');
    }

    public function edit(ShippingAddress $shippingAddress)
    {
         // Sử dụng id_user để kiểm tra quyền
         if ($shippingAddress->id_user != Auth::user()->id_user) {
            abort(403, 'Bạn không có quyền sửa địa chỉ này.');
        }
        return view('shipping_addresses.edit', compact('shippingAddress'));
    }

    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        // Sử dụng id_user để kiểm tra quyền
        if ($shippingAddress->id_user != Auth::user()->id_user) {
            abort(403, 'Bạn không có quyền sửa địa chỉ này.');
        }

        $validator = Validator::make($request->all(), [
             // Sử dụng các tên cột từ migration
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|digits:10',
            'address' => 'required|string',
            'default_address' => 'nullable|boolean',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên người nhận.',
            'full_name.max' => 'Họ và tên người nhận không được quá 255 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.digits' => 'Số điện thoại phải gồm 10 chữ số.',
            'address.required' => 'Vui lòng nhập địa chỉ chi tiết.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('shipping_addresses.edit', $shippingAddress->id_address)
                             ->withErrors($validator)
                             ->withInput();
        }
        $shippingAddress->full_name = $request->input('full_name');
        $shippingAddress->phone = $request->input('phone');
        $shippingAddress->address = $request->input('address');
        $shippingAddress->default_address = $request->input('default_address', 0);
        $shippingAddress->save();

        if ($request->has('default_address') && $request->input('default_address') == 1) {
            // Sử dụng id_user và default_address
            ShippingAddress::where('id_user', Auth::user()->id_user)->where('id_address', '!=', $shippingAddress->id_address)->update(['default_address' => 0]);
            $shippingAddress->default_address = 1;
            $shippingAddress->save();
        } else {
             if ($shippingAddress->default_address && !$request->has('default_address')) {
                // Không làm gì
            } else if (!$shippingAddress->default_address && $request->has('default_address') && $request->input('default_address') == 0) {
                // Nếu đang không phải mặc định và bỏ chọn, không thay đổi
            } else if ($request->has('default_address') && $request->input('default_address') == 0) {
                $shippingAddress->default_address = 0;
                $shippingAddress->save();
            }
        }

        return redirect()->route('shipping_addresses.index')->with('success', 'Cập nhật địa chỉ thành công!');
    }

    public function destroy(ShippingAddress $shippingAddress)
    {
         // Sử dụng id_user để kiểm tra quyền
         if ($shippingAddress->id_user != Auth::user()->id_user) {
            abort(403, 'Bạn không có quyền xóa địa chỉ này.');
        }

        $shippingAddress->delete();

        return redirect()->route('shipping_addresses.index')->with('success', 'Xóa địa chỉ thành công!');
    }
}

