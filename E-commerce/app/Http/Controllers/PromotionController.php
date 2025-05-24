<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Promotion;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
            'name' => 'required|max:100',
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
        ], [
            'name.required' => '* Vui lòng nhập tên chương trình',
            'name.max' => '* Tên chương trình không quá :max ký tự.',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'discount_value.max' => '* Vui lòng nhập giá trị 0-100%',
        ]);
        $input = $request->all();
        // dd($request);
        $promotion = Promotion::create([
            'name' => $input['name'],
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
            'name' => 'required|string|max:255',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $input = $request->all();
        $promotion = Promotion::findOrFail($input['id']);
        // dd($promotion);
        $promotion->name = $input['name'];
        $promotion->discount_value = $input['discount_value'];
        $promotion->start_date = $input['start_date'];
        $promotion->end_date = $input['end_date'];
        $promotion->save();
        return redirect()->route('promotion.list')->withSuccess('Cập nhật thành công');
    }
    public function delete($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            $promotion->delete();
            return redirect()->route('promotion.list')->with('success', 'Xóa thành công');
        } catch (ModelNotFoundException $e) {
            return back()->withErrors([
                'general' => 'Không tìm thấy khuyến mãi cần xóa.'
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi xóa khuyến mãi: ' . $e->getMessage());
            return back()->withErrors([
                'general' => 'Đã xảy ra lỗi khi xóa. Vui lòng thử lại sau.'
            ])->withInput();
        }
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
        $promotion = Promotion::findOrFail($promotionId);
        $promotion->products()->detach($productId);
        return redirect()->back()->withSuccess('Đã xoá sản phẩm khỏi khuyến mãi.');
    }
}
