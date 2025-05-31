<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    const MAX_RECORDS = 50;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //delete data when add new data
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('shipping_addresses')->insert([
                [
                    'id_user' => $i,
                    'full_name' => 'Mr.User',
                    'phone' => '09' . rand(10000000, 99999999),
                    'address' => 'Nha'.$i,
                    'default_address' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
