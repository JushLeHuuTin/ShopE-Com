<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Category extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //delete data when add new data
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('categories')->insert([
                [ 
                    'name' => 'Category'.$i,
                    'slug' => 'e'.$i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}