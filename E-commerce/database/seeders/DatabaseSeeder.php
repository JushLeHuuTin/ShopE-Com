<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //XÓA hoặc comment dòng tạo User mặc định
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Gọi Seeder bạn viết
        $this->call(UserSeeder::class,   CartSeeder::class,);
        
    }
}
