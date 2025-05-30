<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\CleanText;

class CategoryController extends Controller
{
    function show(Category $category)
    {
        $products = $category->products()->paginate(8);
        return view('category', ['category' => $category, 'products' => $products]);
    }
    public function index()
    {
        $categories = Category::paginate(8);
        return view('admin.category', ["categoriess" => $categories]);
    }
    public function create() {
        return view('admin.addcategory');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'max:255', new CleanText(255)],
            'slug' => ['required','unique:categories,slug','string','max:255','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', new CleanText(100)]
        ], [
            'name.required' => '* Vui lòng nhập tên danh mục',
            'name.max' => '* Tên danh mục không được vượt quá :max ký tự.',
            'slug.required' => '* Vui lòng nhập Slug',
            'slug.max' => '* Slug không được vượt quá :max ký tự.',
            'slug.regex' =>'* Slug không đúng định dạng',
            'slug.unique' => '* Slug đã tồn tại, vui lòng chọn slug khác'
        ]);
        Category::create([
            'name' => strip_tags($request->input('name')),
            'slug' => strip_tags($request->input('slug')),
        ]);
        return redirect()->route('category.store')->withSuccess("Tạo danh mục thành công");
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.list')->with('error', "Danh mục không tồn tại hoặc đã bị xoá.");
        }
        $category->delete();
        return redirect()->route('category.list')->withSuccess("Xoá thành công");
    }
    public function edit($id)
    {
        $category = category::findOrFail($id);
        return view('admin.updateCategory', ['category' => $category]);
    }
    public function postEdit(Request $request)
    {
        $request->validate([
            'name' => ['required', new CleanText(255)],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('categories')->ignore($request->input('id'), 'id_category'),
                new CleanText(100)
            ]
        ], [
            'name.required' => '* Vui lòng nhập tên danh mục',
            'name.max' => '* Tên danh mục không được vượt quá :max ký tự.',
            'slug.required' => '* Vui lòng nhập Slug',
            'slug.max' => '* Slug không được vượt quá :max ký tự.',
            'slug.regex' =>'* Slug không đúng định dạng',
            'slug.unique' => '* Slug đã tồn tại, vui lòng chọn slug khác'
        ]);
        $input = $request->all();

        $category = category::findOrFail($input['id']);
        if ($category->updated_at != $request->input('updated_at')) {
            return back()->with('error', 'Dữ liệu đã bị thay đổi bởi người khác.');
        }
 
        $category->name = strip_tags($request->input('name'));
        $category->slug = strip_tags($request->input('slug'));

        $category->save();
        return redirect()->route('category.list')->with('success', "Cập nhật thành công");
    }
}
