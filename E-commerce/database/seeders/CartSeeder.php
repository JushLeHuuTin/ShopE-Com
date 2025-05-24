<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Giả định bạn có user ID và variant ID từ trước
        $userIds = DB::table('users')->pluck('id_user')->toArray();
        $variantIds = DB::table('product_variants')->pluck('id_variant')->toArray();

        // Chèn 10 bản ghi mẫu
        for ($i = 0; $i < 10; $i++) {
            DB::table('cart')->insert([
                'id_user'    => $userIds[array_rand($userIds)],
                'session_id' => Str::uuid(),
                'id_variant' => $variantIds[array_rand($variantIds)],
                'quantity'   => rand(1, 5),
                'price'      => rand(100, 1000), // hoặc lấy từ bảng product_variants nếu muốn
                'added_at'   => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

