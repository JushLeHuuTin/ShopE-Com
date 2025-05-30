<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Product_Variant;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\CleanText;
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
        $featuredProducts = Product::featured()->get();
        $categories = Category::all();

        return view('index', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }
    //hàm lấy ra chi tiết 1 sản phẩm
    public function productDetail($id)
    {
        $product = Product::with('Product_Variants')->findOrFail($id);
        $allComments = Review::select(
            'users.username as username',
            'reviews.rating as rating',
            'reviews.comment as comment',
            'products.name as product_name'
        )
            ->join('users', 'reviews.id_user', '=', 'users.id_user')
            ->join('products', 'reviews.id_product', '=', 'products.id_product')
            ->where('reviews.id_product', $product->id_product)  // chú ý phải đúng trường khóa chính
            ->where('reviews.status', 'browse')
            ->get();


        $commentCount = $allComments->count();

        if ($commentCount > 0) {
            $averageRating = round($allComments->avg('rating'), 1);
        } else {
            $averageRating = 0;
        }
        $comments = $allComments->take(3);
        return view('productdetail', compact('product', 'comments', 'commentCount', 'averageRating'));
    }
    public function allComments($id)
    {
        $product = Product::findOrFail($id);

        $comments = Review::select( 
            'users.username as username',
            'reviews.rating as rating',
            'reviews.comment as comment',
            'products.name as product_name'
        )
            ->join('users', 'reviews.id_user', '=', 'users.id_user')
            ->join('products', 'reviews.id_product', '=', 'products.id_product')
            ->where('reviews.id_product', $product->id_product)
            ->where('reviews.status', 'browse')
            ->get();

        $commentCount = $comments->count();
         if ($commentCount > 0) {
            $averageRating = round($comments->avg('rating'), 1);
        } else {
            $averageRating = 0;
        }

        return view('comment', compact('product', 'comments', 'commentCount', 'averageRating'));
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
            'name' => ['required', new CleanText(100)],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric|min:0|max:99999999',
            'quantity' => 'integer|min:0|max:10000',
            'categories' => ['required', 'integer', 'exists:categories,id_category'],
            'color' => [ new CleanText(20)],
            'size' => [ new CleanText(20)],
        ], [
            'name.required' => '* Vui lòng nhập tên sản phẩm',
            'image.required' => '* Vui lòng chọn hình ảnh sản phẩm.',
            'image.image' => '* Tệp tải lên phải là hình ảnh.',
            'image.mimes' => '* Hình ảnh phải có định dạng: jpg, jpeg hoặc png.',
            'image.max' => '* Dung lượng ảnh không được vượt quá 2MB.',
            'quantity.max' => '* Số lượng không được vượt quá 10.000',
            'price.required' => '* Vui lòng nhập giá',
            'price.max' => '* Vui lòng nhập giá bé hơn 99.999.999đ',
            'quantity.required' => '* Vui lòng nhập số lượng',
            'categories.required' => '* Vui lòng chọn danh mục sản phẩm',
            'categories.integer' => '* Giá trị danh mục không hợp lệ',
            'categories.exists' => '* Danh mục không tồn tại',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath =   $imageName;
        }
        $input = $request->all();
        $product = Product::create([
            'name' => strip_tags($request->input('name')),
            'id_category' => $input['categories'],
            'is_featured' => isset($input['is_featured']) ? 1 : 0,
            'description' => strip_tags($request->input('desc')),
            'image_url' => $imagePath ?? 'null'
        ]);
        if (
            isset($input['size']) && isset($input['color'])
            && isset($input['price']) && isset($input['quantity'])
        ) {
            
            Product_Variant::create([
                'id_product' => $product->id_product,
                'stock' => $input['quantity'],
                'price' => str_replace([',', '.'], '', $input['price']),
                'size' => strip_tags($request->input('size')),
                'color' => strip_tags($request->input('color')),
            ]);
        }
        return redirect()->route('product.add')->withSuccess("Tạo sản phẩm thành công");
    }
    //delete san pham by id
    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.list')->with('error', "Sản phẩm không tồn tại hoặc đã bị xoá.");
        }
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
            'name' => ['required', new CleanText(100)],
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
            'categories' => ['required', 'integer', 'exists:categories,id_category'],
        ], [
            'name.required' => '* Vui lòng nhập tên sản phẩm',
            'name.max' => '* Tên sản phẩm không được vượt quá :max ký tự.',
            'image.image' => '* Tệp tải lên phải là hình ảnh.',
            'image.mimes' => '* Hình ảnh phải có định dạng: jpg, hoặc png.',
            'image.max' => '* Dung lượng ảnh không được vượt quá 2MB.',
            'categories.required' => '* Vui lòng chọn danh mục sản phẩm',
            'categories.integer' => '* Giá trị danh mục không hợp lệ',
            'categories.exists' => '* Danh mục không tồn tại',
        ]);
        
        $input = $request->all();

        $product = Product::findOrFail($input['id']);
        if ($product->updated_at != $request->input('updated_at')) {
            return back()->with('error', 'Dữ liệu đã bị thay đổi bởi người khác.');
        }

        $product->name = strip_tags($request->input('name'));
        $product->description = strip_tags($request->input('desc'));
        $product->id_category = $input['categories'];

        $product->is_featured = isset($input['is_featured']) ? 1 : 0;
        // $product->description = $input['desc'];
        if ($request->has('image')) {
            $imagePath = null;
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath =   $imageName;
            $product->image_url = $imagePath;
        }
        $product->save();
        return redirect()->route('product.list')->with('success', "Cập nhật thành công");
    }
    //search 
    public function search(Request $request)
    {
        $search = $request->query('s');
        $products = Product::searchByKeyword($search);

        return view('search', [
            'products' => $products,
            'search'   => $search
        ]);
    }
}
