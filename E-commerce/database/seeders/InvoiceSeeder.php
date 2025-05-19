<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class InvoiceSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = ['Momo', 'COD', 'Credit Card', 'Bank Transfer', 'E-Wallet'];
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('invoices')->insert([
                [
                    'id_user' => $i,
                    'id_discount' => rand(10, 50),
                    'total_amount' => rand(100, 1000000) / 100,
                    'invoice_date' => Carbon::now()->subDays(rand(0, 365)),
                    'status' => 'completed',
                    'cancellation_reason' => '',
                    'payment_method' => $methods[array_rand($methods)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
