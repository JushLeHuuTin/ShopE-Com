<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
use App\Models\Product;



class Product_Variant extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại và xóa bảng
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_variants')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        $sizes = ['S', 'M', 'L', 'XL'];
        $colors = ['Đỏ', 'Xanh', 'Vàng', 'Đen', 'Trắng'];

        // Lấy tất cả sản phẩm đã có
        $products = Product::all();

        foreach ($products as $product) {
            // Mỗi sản phẩm có 2-4 biến thể
            $variantCount = rand(2, 4);

            for ($i = 0; $i < $variantCount; $i++) {
                DB::table('product_variants')->insert([
                    'id_product' => $product->id_product,
                    'stock' => $faker->numberBetween(10, 100),
                    'price' => $faker->randomFloat(2, 100000, 1000000),
                    'size' => $faker->randomElement($sizes),
                    'color' => $faker->randomElement($colors),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}