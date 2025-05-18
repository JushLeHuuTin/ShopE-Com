<?php

namespace Database\Seeders;

use App\Models\Sessions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Session extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('sessions')->insert([
                [
                    'id' => $i,
                    'user_id' => $i,
                    'ip_address' => '192.168.1.1',
                    'user_agent' => 'none',
                    'payload' => $i.'MB',
                    'last_activity' => now()->timestamp,
                ],
            ]);
        }
    }
}