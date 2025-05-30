<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const MAX_RECORDS = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= self::MAX_RECORDS; $i++) {
            DB::table('users')->insert([
                // Bỏ id_user nếu là auto-increment
                'username' => 'testuser' . $i,
                'email' => 'test' . $i . '@example.com',
                'password' => Hash::make('123456'),
                'phone' => null,
                'avatar' => null,
                'role' => 'customer',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Thêm 1 user admin riêng
        // DB::table('users')->insert([
        //     'username' => 'adminuser',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'),
        //     'phone' => null,
        //     'avatar' => null,
        //     'role' => 'admin',
        //     'is_active' => 2,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
