<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // Đừng quên import Carbon

class StatisticalController extends Controller
{
    public function revenua()
    {
        return view('revenua');
    }

    public function handleDateTime(Request $request)
    {
        $input = $request->input('khoang_thoi_gian'); // Ví dụ: "02/12/2020 08:00 - 10/12/2020 17:30"

        // Tách thành 2 phần: bắt đầu - kết thúc
        [$batDauStr, $ketThucStr] = explode(' - ', $input);

        // Chuyển sang đối tượng Carbon
        $batDau = Carbon::createFromFormat('d/m/Y H:i', trim($batDauStr));
        $ketThuc = Carbon::createFromFormat('d/m/Y H:i', trim($ketThucStr));

        // Truyền dữ liệu xuống view
        return view('revenua', [
            'batDau' => $batDau->format('d/m/Y H:i'),
            'ketThuc' => $ketThuc->format('d/m/Y H:i'),
        ]);
    }
}
