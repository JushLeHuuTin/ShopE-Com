<?php

namespace App\Http\Controllers;
use App\Models\Voucher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CrudVoucherController extends BaseController
{
   public function getList() 
    {
        $vouchers = Voucher::all();
        return view('admin.voucher',['vouchers'=>$vouchers]);
    }
       public function delete($id) 
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route('voucher')->withSuccess("Xoá thành công");
    }
    public function add()
    {
         

    }


    
}
