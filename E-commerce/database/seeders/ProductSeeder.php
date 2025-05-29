<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu bảng products
        DB::table('products')->truncate();

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            Product::create([
                'name' => 'Sản phẩm ' . $i,
                'id_category' => $faker->numberBetween(1, 4), // giả sử có 5 category
                'is_featured' => $faker->boolean() ? 1 : 0,
                'description' => $faker->sentence(10),
                'image_url' => 'Sweater.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
