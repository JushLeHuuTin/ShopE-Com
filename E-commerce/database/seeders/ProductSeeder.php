<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $categories = Category::all();

        if ($categories->count() > 0) {
            for ($i = 1; $i <= 20; $i++) {
                $name = 'Sản phẩm ' . $i;
                $randomCategory = $categories->random();

                Product::create([
                    // 'id_product' => $i, // XÓA dòng này để auto-increment hoạt động
                    'name' => $name,
                    'id_category' => $randomCategory->id_category,
                    'is_featured' => $faker->boolean(),
                    'description' => $faker->paragraph(3),
                    'image_url' => 'product_' . $i . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}