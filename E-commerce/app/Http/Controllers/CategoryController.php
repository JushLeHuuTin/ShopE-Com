<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    function show(Category $category){
$products = $category->products()->paginate(8);
        return view('category',['category'=>$category,'products'=>$products]);
    }
}
