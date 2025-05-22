<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Promotion;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    //
    public function add(){
        $products = Product::all();
        return view('admin.addPromotion',['products'=>$products]);

    }
    public function postPromotion(request $request){
         $request->validate([
            'name' => 'required|max:100',
            'discount_value' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ], [
            'name.required' => '* Vui lòng nhập tên chương trình',
            'name.max' => '* Tên chương trình không quá :max ký tự.',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'image.image' => '* Tệp tải lên phải là hình ảnh.',
            'image.mimes' => '* Hình ảnh phải có định dạng: jpg, jpeg hoặc png.',
            'image.max' => '* Dung lượng ảnh không được vượt quá 2MB.',
            'price.required' => '* Vui lòng nhập giá',
            'quantity.required' => '* Vui lòng nhập số lượng',
        ]);
        $input = $request->all();
                dd($request);
        $promotion = Promotion::create([
            'name' => $input['name'],
            'discount_value' => $input['discount_value'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date']
        ]);
        if($input['id_product']!=0){
            Product_Promotion::create([
                'id_product' => $input['id_prouct'],
                'id_promotion' => $promotion->id_promotion
            ]);
        }
        return redirect()->route('promotion.add')->withSuccess("Thêm chương trình khuyến mãi thành công!");

    }
}
