<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Rules\CleanText;

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
        $voucher = Voucher::find($id);
        if (!$voucher) {
            return redirect()->route('voucher.list')->with('error',"Sản phẩm không tồn tại hoặc đã bị xoá.");
        }
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
            'code' => ['required','unique:discount_codes,code', new CleanText(50)],
            'expiration_date' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lt(Carbon::now())) {
                        $fail('* Vui lòng chọn ngày lớn hơn ngày hiện tại');
                    }
                },
            ],
            'discount_value' => 'required|numeric|min:1|max:100',
            'max_uses' => 'required|numeric|min:1|max:200'
        ], [
            'code.required' => '* Vui lòng không bỏ trống',
            'code.unique' => '* Mã đã tồn tại trên hệ thống.',
            'expiration_date.required' => '* Vui lòng chọn ngày kết thúc',
            'discount_value.max' => '* Vui lòng nhập giá trị 1-100%',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'max_uses.required' => '* Vui lòng không bỏ trống',
            'max_uses.max' => '* Vui lòng nhập giá trị 1 - :max',
        ]);
        $input = $request->all();
        Voucher::create([
            'code' => strip_tags($request->input('code')),
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
            'code' => 'required|max:50',
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
            'max_uses' => 'required|numeric|min:1|max:200'
        ], [
            'code.required' => '* Vui lòng không bỏ trống',
            'expiration_date.required' => '* Vui lòng chọn ngày kết thúc',
            'discount_value.max' => '* Vui lòng nhập giá trị 0-100%',
            'discount_value.required' => '* Vui lòng không bỏ trống',
            'max_uses.required' => '* Vui lòng không bỏ trống',
            'max_uses.max' => '* Vui lòng nhập giá trị 1 - :max',
        ]);
        
        $input = $request->all();
        $voucher = Voucher::findOrFail($input['id']);
        if ($voucher->updated_at != $request->input('updated_at')) {
            return back()->with('error', 'Dữ liệu đã bị thay đổi bởi người khác.');
        }
        $voucher->code = strip_tags($request->input('code'));
        $voucher->discount_value = $input['discount_value'];
        $voucher->expiration_date = $input['expiration_date'];
        $voucher->max_uses = $input['max_uses'];
        $voucher->save();
        return redirect()->route('voucher.list')->withSuccess("Cập nhật thành công");
    }
}
