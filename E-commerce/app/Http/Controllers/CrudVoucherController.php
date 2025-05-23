<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CrudVoucherController extends BaseController
{
    public function getList()
    {
        $vouchers = Voucher::all();
        return view('admin.voucher', ['vouchers' => $vouchers]);
    }
    public function delete($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route('voucher.list')->withSuccess("Xoá thành công");
    }
    public function add()
    {
        return view('admin.addVoucher');
    }
    public function postVoucher(request $request)
    {
        $request->validate([
            'code' => 'required|max:100',
            'expiration_date' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lt(Carbon::now())) {
                        $fail('*Vui lòng chọn ngày lớn hơn ngày hiện tại');
                    }
                },
            ],
            'discount_value' => 'required',
            'discount_value' => 'required|numeric|min:0|max:50',
            'max_uses' => 'required'
        ], [
            'code.required' => '* Vui lòng không bỏ trống',
            'code.max' => '* Mã không được vượt quá :max ký tự.',
            'expiration_date.required' => '* Vui lòng chọn ngày kết thúc',
            'discount_value.max' => '* Vui lòng nhập giá trị 0-100%',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'max_uses.required' => '* Vui lòng không bỏ trống',
        ]);
        $input = $request->all();
        //  dd($input);
        Voucher::create([
            'code' => $input['code'],
            'discount_value' => $input['discount_value'],
            'expiration_date' => $input['expiration_date'],
            'max_uses' => $input['max_uses']
        ]);
        return redirect()->route('voucher.add')->withSuccess("Tạo voucher thành công");
    }
    public function update($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.updateVoucher', ['voucher' => $voucher]);
    }
    public function postUpdate(request $request)
    {
        $request->validate([
            'code' => 'required|max:100',
            'expiration_date' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lt(Carbon::now())) {
                        $fail('*Vui lòng chọn ngày lớn hơn ngày hiện tại');
                    }
                },
            ],
            'discount_value' => 'required',
            'discount_value' => 'required|numeric|min:0|max:50',
            'max_uses' => 'required'
        ], [
            'code.required' => '* Vui lòng không bỏ trống',
            'code.max' => '* Mã không được vượt quá :max ký tự.',
            'expiration_date.required' => '* Vui lòng chọn ngày kết thúc',
            'discount_value.max' => '* Vui lòng nhập giá trị 0-100%',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'max_uses.required' => '* Vui lòng không bỏ trống',
        ]);
        
        $input = $request->all();
        $voucher = Voucher::findOrFail($input['id']);
        $voucher->code = $input['code'];
        $voucher->discount_value = $input['discount_value'];
        $voucher->expiration_date = $input['expiration_date'];
        $voucher->max_uses = $input['max_uses'];
        $voucher->save();
        return redirect()->route('voucher.list')->withSuccess("Cập nhật thành công");
    }
}
