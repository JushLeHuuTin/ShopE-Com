<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    const MAX_RECORDS = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Đồ thể thao',
            'Đồ tập gym',
            'Đồ chạy bộ',
            'Đồ bơi',
            'Category Random 1',
            'Category Random 2',
            'Category Random 3',
            'Category Random 4',
        ];

        foreach ($categories as $index => $name) {
            DB::table('categories')->insert([
                'id_category' => $index + 1,
                'name' => $name,
                'slug' => Str::slug($name) . '-' . ($index + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
