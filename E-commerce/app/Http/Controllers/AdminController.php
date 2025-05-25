<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function lockUser(Request $request, $id) // Đổi tên thành 'lock'
    {
        $user = User::findOrFail($id);
        if (!$user->is_active) {
            return redirect()->back()->with('warning', "Tài khoản của người dùng {$user->username} đã bị khóa.");
        }
        $user->is_active = false;
        if ($user->save()) {
            return redirect()->back()->with('success', "Đã khóa tài khoản của người dùng {$user->username} thành công!");
        } else {
            return redirect()->back()->with('error', 'Không thể khóa tài khoản. Vui lòng thử lại.');
        }
    }

    public function unlockUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->is_active) {
            return redirect()->back()->with('warning', "Tài khoản của người dùng {$user->username} đã được kích hoạt.");
        }
        $user->is_active = true;
        if ($user->save()) {
            return redirect()->back()->with('success', "Đã kích hoạt tài khoản của người dùng {$user->username} thành công!");
        } else {
            return redirect()->back()->with('error', 'Không thể kích hoạt tài khoản. Vui lòng thử lại.');
        }
    }

}
