<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- RẤT QUAN TRỌNG: Đảm bảo dòng này có

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Kiểm tra vai trò của người dùng (dùng cột is_active = 2 cho Admin)
        // Auth::user() sẽ trả về đối tượng User của người dùng đang đăng nhập.
        // Bạn đã nói rằng 1 là User, 2 là Admin.
        if (Auth::user()->role !== 'admin') {
            // Nếu người dùng không phải là admin (is_active không phải 2)
            // Hiển thị lỗi 403 Forbidden hoặc chuyển hướng về trang chủ
            abort(403, 'Bạn không có quyền truy cập trang quản trị này.'); // Hiển thị lỗi 403
            // Hoặc: return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        // Nếu người dùng đã đăng nhập và là admin, cho phép yêu cầu tiếp tục
        return $next($request);
    }
}