<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo một vài invoice mẫu
        $invoices = [
            [
                'id_user' => 1,
                'id_discount' => null,
                'total_amount' => 500000,
                'invoice_date' => Carbon::now(),
                'status' => 'pending',
                'cancellation_reason' => null,
                'payment_method' => 'COD',
            ],
            [
                'id_user' => 1,
                'id_discount' => null,
                'total_amount' => 750000,
                'invoice_date' => Carbon::now()->subDays(1),
                'status' => 'done',
                'cancellation_reason' => null,
                'payment_method' => 'Momo',
            ],
        ];

        foreach ($invoices as $invoice) {
            $id_invoice = DB::table('invoices')->insertGetId($invoice);

            // Mỗi invoice có 2 sản phẩm
            DB::table('invoices_detail')->insert([
                [
                    'id_invoice' => $id_invoice,
                    'id_variant' => 1, // bạn cần đảm bảo id_variant này tồn tại
                    'quantity' => 2,
                    'price' => 200000,
                ],
                [
                    'id_invoice' => $id_invoice,
                    'id_variant' => 2, // bạn cần đảm bảo id_variant này tồn tại
                    'quantity' => 1,
                    'price' => 100000,
                ],
            ]);
        }
    }
}
