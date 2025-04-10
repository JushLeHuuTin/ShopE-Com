<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudUserController extends Controller
{
    public function login()
    {
        return view('welcome');
    }
    public function index()
    {
        return view('index');
    }
}
