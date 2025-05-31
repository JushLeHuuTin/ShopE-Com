<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Product extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('products')->insert([
                [
                    'name' => 'Product'.$i,
                    'id_category' => rand(1, 4),
                    'is_featured' => rand(0, 1),
                    'description' => 'This is a good product',
                    'image_url' => 'Sweater.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}