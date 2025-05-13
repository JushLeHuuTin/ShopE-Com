<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Áo',
            'Quần',
            'Giày dép',
            'Phụ kiện',
            'Đồ điện tử',
            // Thêm các danh mục khác của bạn
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'id_category' => null, // Để auto-increment quản lý
                'name' => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}