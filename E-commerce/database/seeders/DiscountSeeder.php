<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DiscountSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('discount_codes')->insert([
                [
                    'code' => $i,
                    'discount_value' => rand(10, 50),
                    'expiration_date' => Carbon::now()->addDays(30),
                    'max_uses' => rand(10, 50),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}