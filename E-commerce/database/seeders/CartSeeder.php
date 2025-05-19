<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CartSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //delete data when add new data
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('cart')->insert([
                [ 
                    'id_user' => $i,
                    'session_id' => $i,
                    'id_variant' => $i,
                    'quantity' => rand(10, 100),
                    'price' => rand(10000, 99999),
                    'added_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}