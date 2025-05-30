<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Promotion;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Rules\CleanText;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    //
    public function index()
    {
        $promotions = Promotion::paginate(10);
        return view('admin.promotion', ['promotions' => $promotions]);
    }
    public function add()
    {
        $currentDay = Carbon::now()->format('Y-m-d');
        $products = Product::all();
        $data = [
            'products' => $products,
            'currentday' => $currentDay
        ];
        return view('admin.addPromotion', $data);
    }
    public function postPromotion(request $request)
    {
        $request->validate([
            'name' => ['required','string',new CleanText(100)],
            'discount_value' => 'required|numeric|min:0|max:100',
            'start_date' => 'required',
            'end_date' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = Carbon::parse($request->input('start_date'));
                    $endDate = Carbon::parse($value);

                    if ($endDate->lt($startDate)) {
                        $fail('* Vui lòng chọn ngày kết thúc lớn hơn ngày bắt đầu');
                    }
                },
            ],
            'id_product' => [ 'integer', 'exists:products,id_product'],

        ], [
            'name.required' => '* Vui lòng nhập tên chương trình',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'discount_value.max' => '* Vui lòng nhập giá trị 0-100%',
            'start_date.required' => '* Vui lòng chọn ngày bắt đầu',
            'end_date.required' => '* Vui lòng chọn ngày kết thúc',
            'id_product.integer' => '* Sản phẩm không hợp lệ',
            'id_product.exists' => '* Sản phẩm không tồn tại',

        ]);
        $input = $request->all();
        // dd($request);
        $promotion = Promotion::create([
            'name' => strip_tags($request->input('name')),
            'discount_value' => $input['discount_value'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date']
        ]);
        if ($input['id_product'] != 0) {
            Product_Promotion::create([
                'id_product' => $input['id_product'],
                'id_promotion' => $promotion->id_promotion
            ]);
        }
        return redirect()->route('promotion.add')->withSuccess("Thêm chương trình khuyến mãi thành công!");
    }
    public function update($id)
    {
        $promotion = promotion::findOrFail($id);
        return view('admin.updatePromotion', ['promotion' => $promotion]);
    }
    public function postUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:promotions,id_promotion',
            'name' => ['required','string',new CleanText(100)],
            'discount_value' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'name.required' => '* Vui lòng nhập tên chương trình',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'discount_value.max' => '* Vui lòng nhập giá trị 0-100%',
            'start_date.required' => '* Vui lòng chọn ngày bắt đầu',
            'end_date.required' => '* Vui lòng chọn ngày kết thúc',
            'id.integer' => '* Chương trình không hợp lệ',
            'id.exists' => '* Chương trình không tồn tại',

        ]);
        $input = $request->all();
        $promotion = Promotion::findOrFail($input['id']);
        if ($promotion->updated_at != $request->input('updated_at')) {
            return back()->with('error', 'Dữ liệu đã bị thay đổi bởi người khác.');
        }
        $promotion->name = strip_tags($request->input('name'));
        $promotion->discount_value = $input['discount_value'];
        $promotion->start_date = $input['start_date'];
        $promotion->end_date = $input['end_date'];
        $promotion->save();
        return redirect()->route('promotion.list')->withSuccess('Cập nhật thành công');
    }
    public function delete($id)
    {
        $promotion = promotion::find($id);
        if (!$promotion) {
            return redirect()->route('promotion.list')->with('error', "Chương trình không tồn tại hoặc đã bị xoá.");
        }
        $promotion->delete();
        return redirect()->route('promotion.list')->withSuccess("Xoá thành công");
    }
    public function listProducts($id)
    {
        $promotion = Promotion::with('products')->findOrFail($id);
        $products = $promotion->products;
        $data = [
            'promotion' => $promotion,
            'products' => $products
        ];
        return view('admin.promotionProducts', $data);
        try {
        } catch (ModelNotFoundException $e) {
            return redirect()->route('promotion.list')
                ->with('error', 'Không tìm thấy chương trình khuyến mãi.');
        } catch (Exception $e) {
            Log::error('Lỗi khi load danh sách sản phẩm theo khuyến mãi: ' . $e->getMessage());
            return redirect()->route('promotion.list')
                ->with('error', 'Đã xảy ra lỗi khi tải danh sách sản phẩm.');
        }
    }
    public function deleteProduct($promotionId, $productId)
    {
        $promotion = Promotion::find($promotionId);
        if (!$promotion) {
            return redirect()->route('promotion.list')->with('error', 'Chương trình không tồn tại.');
        }
        $product = product::find($productId);
        if (!$product) {
            return redirect()->route('product.list')->with('error', '');
        }
    
        // Kiểm tra sản phẩm có trong promotion không
        if (!$promotion->hasProduct($productId)) {
            return redirect()->back()->with('error', 'Sản phẩm không thuộc chương trình này.');
        }
    
        // Thực hiện tách
        $promotion->products()->detach($productId);
    
        return redirect()->back()->with('success', 'Đã xoá sản phẩm khỏi khuyến mãi.');
    }
    public function addForm($promotionId)
    {
        $promotion = Promotion::findOrFail($promotionId);
        $promotions = Promotion::all();
        $products = Product::all();
        $data = [
            'promotions' => $promotions,
            'products' => $products,
            'promotion' => $promotion
        ];
        return view('admin.addPromotionProduct', $data);    
    }
    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'promotion' => 'required|exists:promotions,id_promotion',
            'product'   => 'required|exists:products,id_product',
        ], [
            'promotion.required' => '* Vui lòng chọn chương trình.',
            'product.required'   => '* Vui lòng chọn sản phẩm.',
            'promotion.exists'     => '* Chương trình không tồn tại.',
            'product.exists'     => '* Sản phẩm không tồn tại.',
        ]);
    
        $promotion = Promotion::findOrFail($validated['promotion']);
    
        if ($promotion->hasProduct($validated['product'])) {
            return redirect()->back()->with('error', 'Sản phẩm đã tồn tại trong chương trình.');
        }
    
        $promotion->products()->attach($validated['product']);
    
        return redirect()->back()->with('success', 'Thêm sản phẩm thành công.');
    }
}
