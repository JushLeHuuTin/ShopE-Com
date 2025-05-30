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
        for ($i = 1; $i <= self::MAX_RECORDS; $i++) {
            DB::table('categories')->insert([
                [
                    'id_category' => $i,
                    'name' => 'Category ' . $i,
                    'slug' => Str::slug('Category ' . $i) . '-' . $i, // đảm bảo slug là duy nhất
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
