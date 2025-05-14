<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Lấy danh sách người dùng
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function lock($id)
{
    $user = User::findOrFail($id);
    $user->is_active = false;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Tài khoản đã bị khóa.');
}

public function unlock($id)
{
    $user = User::findOrFail($id);
    $user->is_active = true;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Tài khoản đã được kích hoạt lại.');
}

}
