<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class CrudUserController extends Controller
{
    public function login()
    {
        return view('welcome');
    }
    public function index()
    {
        $users = User::paginate(10); // lấy 10 người dùng mỗi trang
        return view('admin.users.index', compact('users'));
    }

    public function lock($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false;
        $user->save();

        return back()->with('success', 'Người dùng đã bị khóa.');
    }

    public function unlock($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = true;
        $user->save();

        return back()->with('success', 'Người dùng đã được kích hoạt.');
    }

    public function changePassword(Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        // 2. Kiểm tra mật khẩu cũ
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng.']);
        }

        // 3. Mã hóa và cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);  // Mã hóa mật khẩu ở đây
        $user->save();

        // 4. Đăng xuất người dùng và chuyển hướng
        Auth::logout();
        return redirect('/login')->with('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại.');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password'); //Tạo view này
    }

}
