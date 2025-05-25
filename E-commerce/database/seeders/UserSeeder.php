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
        DB::table('users')->insert([
            'id_user' => 1, // Hoặc để auto-increment nếu bạn không chỉ định
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'phone' => null,
            'avatar' => null,
            'role' => 'customer',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id_user' => 2, // Hoặc để auto-increment
            'username' => 'adminuser',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => null,
            'avatar' => null,
            'role' => 'admin',
            'is_active' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bạn có thể thêm nhiều user mẫu khác nếu cần
    }
}