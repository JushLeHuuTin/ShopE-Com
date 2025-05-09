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
}
