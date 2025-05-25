<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str; // Thêm thư viện Str để tạo username ngẫu nhiên

class AuthOtpController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255', // Thay 'name' thành 'username'
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Tạo mã OTP
        $otp = rand(100000, 999999);

        // Lưu tạm vào session
        Session::put('register_data', [
            'username' => $request->username,   // Lưu 'username' thay vì 'name'
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'otp' => $otp,
        ]);

        // Gửi OTP qua email
        Mail::raw("Mã xác minh OTP của bạn là: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Mã xác minh OTP');
        });

        return redirect()->route('verify.otp.form')->with('message', 'OTP đã được gửi đến email của bạn.');
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }




    /**
     * Hiển thị form nhập OTP
     */
    public function showOtpForm()
    {
        return view('auth.verify-otp'); // Bạn cần tạo view này
    }

    /**
     * Xử lý gửi OTP tới email người dùng
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tạo OTP ngẫu nhiên
        $otp = rand(100000, 999999);

        // Lưu OTP vào session
        Session::put('otp_code', $otp);
        Session::put('otp_email', $request->email);

        // Gửi OTP qua email
        Mail::raw("Mã xác thực OTP của bạn là: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Mã xác thực OTP');
        });

        return redirect()->route('verify.otp')->with('success', 'Đã gửi OTP. Vui lòng kiểm tra email.');
    }

    /**
     * Xác thực OTP
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $inputOtp = $request->input('otp');
        $registerData = session('register_data');
        $sessionOtp = $registerData['otp'] ?? null;

        // Kiểm tra OTP
        if ((int) $inputOtp === (int) $sessionOtp) {
            // Lưu thông tin người dùng vào cơ sở dữ liệu
            $userData = session('register_data');
            $username = $userData['username']; // Lấy username từ session

            // Kiểm tra xem username đã tồn tại chưa
            $existingUser = User::where('username', $username)->first();

            // Nếu username đã tồn tại, tạo một username mới duy nhất
            if ($existingUser) {
                $username .= '-' . Str::random(5); // Thêm một chuỗi ngẫu nhiên vào username // Đánh dấu sửa 1
            }

            // Tạo người dùng mới và lưu vào bảng users
            $user = User::create([
                'username' => $username,   // Sử dụng username (có thể đã được tạo mới) // Đánh dấu sửa 2
                'email' => $userData['email'],
                'password' => $userData['password'],  // Mật khẩu đã mã hóa
            ]);

            // Xóa dữ liệu đăng ký khỏi session
            Session::forget('register_data');

            // Đăng nhập người dùng sau khi đăng ký thành công
            auth()->login($user);

            return redirect()->route('login')->with('success', 'Đăng ký và xác thực OTP thành công!');
        } else {
            return back()->withErrors(['otp' => 'Mã OTP không đúng. Vui lòng thử lại.']);
        }
    }
}