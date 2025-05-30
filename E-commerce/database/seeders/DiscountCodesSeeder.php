<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DiscountCodesSeeder extends Seeder
{
    public function run()
    {
        $discounts = [];

        for ($i = 0; $i < 10; $i++) {
            $discounts[] = [
                'code' => strtoupper(Str::random(6)), // Ví dụ: 'ABC123'
                'discount_value' => rand(5000, 50000), // từ 5.000đ đến 50.000đ
                'expiration_date' => Carbon::now()->addDays(rand(5, 30)), // hết hạn sau 5 - 30 ngày
                'max_uses' => rand(10, 100), // từ 10 đến 100 lượt dùng
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('discount_codes')->insert($discounts);
    }
}
