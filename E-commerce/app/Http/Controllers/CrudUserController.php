<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;

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

}
