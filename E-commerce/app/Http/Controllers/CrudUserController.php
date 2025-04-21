<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudUserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function index()
    {
        return view('index');
    }
}
