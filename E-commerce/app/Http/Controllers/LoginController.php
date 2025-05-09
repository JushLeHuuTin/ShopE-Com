<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');  // Đảm bảo có file view 'auth.login'
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra mật khẩu
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Phân quyền theo role
            if ($user->is_active === 2) {
                \Log::info('Đăng nhập thành công với role: ' . $user->role);
                return redirect()->route('admin.users.index')->with('success', 'Đăng nhập thành công với quyền Admin!');;  // Đảm bảo rằng route này đã được định nghĩa trong web.php

            } elseif ($user->is_active === 1) {
                \Log::info('Đăng nhập thành công với role: ' . $user->role);
                return redirect()->route('index')->with('success', 'Đăng nhập thành công với quyền customer!');;  // Đảm bảo route này tồn tại và không bị lỗi

            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Lỗi quyền truy cập, liên hệ quản trị viên.']);
            }
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
    }

    // Đăng xuất người dùng
    public function logout()
    {
        Auth::logout();  // Đăng xuất
        return redirect('/login')->with('success', 'Đăng xuất thành công!');
    }
}
