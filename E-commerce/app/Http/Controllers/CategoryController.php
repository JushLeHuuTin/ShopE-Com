<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(8);
        return view('admin.category', ["categoriess" => $categories]);
    }
    public function destroy($id){
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.list')->with('error', "Danh mục không tồn tại hoặc đã bị xoá.");
        }
        $category->delete();
        return redirect()->route('category.list')->withSuccess("Xoá thành công");
    }
}
