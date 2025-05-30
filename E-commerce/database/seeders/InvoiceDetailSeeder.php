<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

class InvoiceDetailSeeder extends Seeder
{
    public function run(): void
    {
        $invoice1 = Invoice::first(); // hoặc ->find(1)
        $invoice2 = Invoice::skip(1)->first(); // hoặc ->find(2)

        if (!$invoice1 || !$invoice2) {
            $this->command->warn('Invoices chưa có dữ liệu phù hợp. Chạy InvoiceSeeder trước.');
            return;
        }

        InvoiceDetail::insert([
            [
                'id_invoice' => $invoice1->id_invoice,
                'id_variant' => 1,
                'price' => 250000,
                'quantity' => 2
            ],
            [
                'id_invoice' => $invoice1->id_invoice,
                'id_variant' => 2,
                'price' => 100000,
                'quantity' => 1
            ],
            [
                'id_invoice' => $invoice2->id_invoice,
                'id_variant' => 1,
                'price' => 250000,
                'quantity' => 1
            ],
            [
                'id_invoice' => $invoice2->id_invoice,
                'id_variant' => 3,
                'price' => 200000,
                'quantity' => 2
            ],
        ]);
    }
}
