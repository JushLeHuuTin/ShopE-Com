<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class InvoiceSeeder extends Seeder
{
    const MAX_RECORDS = 100;

    public function run(): void
    {
        $methods = ['Momo', 'COD', 'Credit Card', 'Bank Transfer', 'E-Wallet'];
        $statu = ['pending', 'completed', 'cancelled'];

        for ($i = 1; $i < self::MAX_RECORDS; $i++) {

            DB::table('invoices')->insert([
                'id_user' => $i,
                'id_discount' => rand(10, 50),
                'total_amount' => rand(100000, 999999), // Tạm thời
                'invoice_date' => Carbon::now()->subDays(rand(0, 365)),
                'status' => $statu[array_rand($statu)],
                'cancellation_reason' => '',
                'payment_method' => $methods[array_rand($methods)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
