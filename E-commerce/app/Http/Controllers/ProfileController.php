<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|digits:10',
        ], [
            'name.required' => 'Vui lòng điền đầy đủ họ và tên.',
            'name.max' => 'Họ và tên không được quá 255 ký tự.',
            'phone.required' => 'Vui lòng điền số điện thoại.',
            'phone.digits' => 'Số điện thoại phải gồm 10 chữ số.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                             ->withErrors($validator)
                             ->withInput();
        }

        $user->username = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Cập nhật thông tin thành công!');
    }
}