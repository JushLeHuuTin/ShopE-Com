<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Variant;
// use App\Models\Product_Variants;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Session as FacadesSession;

class CrudProductController extends Controller
{
    //hàm index get sản phẩm nổi bật 
    public function index()
    {
        $featuredProducts = Product::with('defaultVariant')
            ->where('is_featured', 1)
            ->get();
        return view('index', ['featuredProducts' => $featuredProducts]);
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
        $product = Product::with('Product_Variants')->findOrFail($id);
        // dd($id);
        $variant = null;
        if ($request->has('variant_id')) {
            $variant = Product_Variant::find($request->variant_id);
        }

        return view('productDetail', compact('product', 'variant'));
        $featuredProducts = Product::where('is_featured', 1)->get();
        return view('welcome', compact('featuredProducts'));
    }
    //hàm hiển thị trang thêm sản phẩm
    public function add()
    {
        $category = Category::all();
        $data = [
            'category' => $category
        ];
        return view('admin.product', $data);
    }

    public function postProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $category = Category::all();
        $data = [
            'category' => $category
        ];
        $input = $request->all();
        $product = Product::create([
            'name' => $input['name'],
            'id_category' => $input['categories'],
            'is_featured' => isset($input['is_featured'])?1:0,
            'description' => $input['desc'],
            'image_url' => $input['image']??'null'
        ]);
        if(isset($input['size']) && isset($input['color'])
        && isset($input['price']) && isset($input['quantity'])
        ){
            Product_Variant::create([
                'id_product' => $product->id_product,
                'stock' => $input['quantity'],
                'price' => $input['price'],
                'size' => $input['size'],
                'color' => $input['color']
            ]);
        }
        // dd($input);
     
        return redirect()->route('product.add')->withSuccess("Tạo sản phẩm thành công");
    }
}
