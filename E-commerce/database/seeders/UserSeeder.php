<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('user')->insert([
                [
                    'username' => "user$i",
                    'password' => Hash::make('123456'),
                    'email' => "user$i@gmail.com",
                    'phone' => '09' . rand(10000000, 99999999),
                    'avatar' => 'avatar.jpg',
                    'role' => "customer$i",
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}