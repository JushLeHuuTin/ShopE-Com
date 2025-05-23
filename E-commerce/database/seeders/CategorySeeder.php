<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id_category' => 1,
                'name' => 'Điện thoại',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_category' => 2,
                'name' => 'Laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_category' => 3,
                'name' => 'Phụ kiện',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_category' => 4,
                'name' => 'Phụ kiện',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
