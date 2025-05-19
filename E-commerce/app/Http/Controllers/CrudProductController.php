<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Variant;
// use App\Models\Product_Variants;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Session as FacadesSession;

class CrudProductController extends Controller
{
    //get list product at admin
    public function getProduct()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.product', ["products" => $products]);
    }
    //hàm index get sản phẩm nổi bật 
    public function index()
    {
        $featuredProducts = Product::with('defaultVariant')
            ->where('is_featured', 1)
            ->take(8)
            ->get();
        $categories = Category::all();
        $data = [
            "featuredProducts" => $featuredProducts,
            "categories" => $categories,
        ];
        return view('index', $data);
    }
    //hàm lấy ra chi tiết 1 sản phẩm
    public function productDetail($id)
    {
        $product = Product::with('Product_Variants')->findOrFail($id);
        return view('productdetail', compact('product'));
    }
    //hàm lấy ra chi tiết thuộc tính theo id_variant
    public function show(Request $request, $id)
    {
        $product = Product::with('product_Variants')->findOrFail($id);
        $variant = null;
        if ($request->has('variant_id')) {
            $variant = Product_Variant::find($request->variant_id);
        }
        return view('productDetail', compact('product', 'variant'));
    }
    //hàm hiển thị trang thêm sản phẩm
    public function add()
    {
        //    if(Auth::check()){
        $category = Category::all();
        $data = [
            'category' => $category
        ];
        return view('admin.addProduct', $data);
        // }
        // return view('login');
    }

    public function postProduct(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required',
            'quantity' => 'required'
        ], [
            'name.required' => '* Vui lòng nhập tên sản phẩm',
            'name.max' => '* Tên sản phẩm không được vượt quá :max ký tự.',
            'image.required' => '* Vui lòng chọn hình ảnh sản phẩm.',
            'image.image' => '* Tệp tải lên phải là hình ảnh.',
            'image.mimes' => '* Hình ảnh phải có định dạng: jpg, jpeg hoặc png.',
            'image.max' => '* Dung lượng ảnh không được vượt quá 2MB.',
            'price.required' => '* Vui lòng nhập giá',
            'quantity.required' => '* Vui lòng nhập số lượng',
        ]);
        //
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath =   $imageName;
        }
        //
        $category = Category::all();
        $data = [
            'category' => $category
        ];
        //
        $input = $request->all();
        $product = Product::create([
            'name' => $input['name'],
            'id_category' => $input['categories'],
            'is_featured' => isset($input['is_featured']) ? 1 : 0,
            'description' => $input['desc'],
            'image_url' => $imagePath ?? 'null'
        ]);
        if (
            isset($input['size']) && isset($input['color'])
            && isset($input['price']) && isset($input['quantity'])
        ) {
            Product_Variant::create([
                'id_product' => $product->id_product,
                'stock' => $input['quantity'],
                'price' => $input['price'],
                'size' => $input['size'],
                'color' => $input['color'] != 'custom' ? $input['color'] : $input['colorOther']
            ]);
        }
        return redirect()->route('product.add')->withSuccess("Tạo sản phẩm thành công");
    }
    //delete san pham by id
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.list')->withSuccess("Xoá thành công");
    }
    //cap nhap lai san pham
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.updateProduct', ['product' => $product]);
    }
    public function postEdit(request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
            // 'price' => 'required',
            // 'quantity' => 'required'
        ], [
            'name.required' => '* Vui lòng nhập tên sản phẩm',
            'name.max' => '* Tên sản phẩm không được vượt quá :max ký tự.',
            'image.required' => '* Vui lòng chọn hình ảnh sản phẩm.',
            'image.image' => '* Tệp tải lên phải là hình ảnh.',
            'image.mimes' => '* Hình ảnh phải có định dạng: jpg, hoặc png.',
            'image.max' => '* Dung lượng ảnh không được vượt quá 2MB.',
            'price.required' => '* Vui lòng nhập giá',
            'quantity.required' => '* Vui lòng nhập số lượng',
        ]);

        $input = $request->all();
        $product = Product::findOrFail($input['id']);
        // dd($input);
        $product->name = $input['name'];
        $product->id_category = $input['categories'];

        if ($request->has('is_featured')) {

            $product->is_featured = $input['is_featured'] == 'on' ? 1 : 0;
        }
        $product->description = $input['desc'];
        if ($request->has('image')) {
            $imagePath = null;
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            if (strtolower($extension) !== 'jpg' && strtolower($extension) !== 'png') {
                return back()->withErrors(['image' => '* Chỉ chấp nhận file JPG hoặc PNG']);
            }
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath =   $imageName;
            $product->image_url = $imagePath;
        }
        $product->save();
        return redirect()->route('product.list')->withSuccess("Cập nhật thành công");
    }
}
