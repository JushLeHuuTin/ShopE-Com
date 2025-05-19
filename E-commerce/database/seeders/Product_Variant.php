<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Product_Variant extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = ['S', 'M', 'L', 'XXL'];
        $colors = ['Red', 'Yellow', 'Green', 'Black'];
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('product_variants')->insert([
                [
                    'id_product' => $i,
                    'stock' => rand(10, 100),
                    'price' => rand( 100000, 9999999),
                    'size' => array_rand($sizes),
                    'color' => array_rand($colors),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}