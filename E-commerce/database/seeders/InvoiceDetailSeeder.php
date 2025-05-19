<?php

namespace Database\Seeders;

use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class InvoiceDetailSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('invoices_detail')->insert([
                [
                    'id_invoice' => $i,
                    'id_variant' => $i,
                    'quantity' => rand(10, 100 ),
                    'price' => rand(10000, 99999),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}