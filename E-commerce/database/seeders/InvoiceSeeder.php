<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $users = User::all();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                Invoice::create([
                    'id_invoice' => null,
                    'id_user' => $user->id_user,
                    'id_discount' => 123, // Chèn id giảm giá ngẫu nhiên từ 1 đến 100 (có thể null)
                    'total_amount' => $faker->numberBetween(100000, 1000000),
                    'invoice_date' => $faker->dateTimeBetween('-1 year', 'now'),
                    'status' => $faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
                    'cancellation_reason' => $faker->optional()->sentence(),
                    'payment_method' => $faker->randomElement(['Momo', 'COD', 'Credit Card', 'Bank Transfer']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Tạo thêm một hóa đơn để test phân trang (nếu cần)
            $userForLargeInvoice = $users->random();
            Invoice::create([
                'id_invoice' => null,
                'id_user' => $userForLargeInvoice->id_user,
                'id_discount' => 123,
                'total_amount' => 0,
                'invoice_date' => $faker->dateTimeBetween('-6 months', 'now'),
                'status' => 'processing',
                'cancellation_reason' => null,
                'payment_method' => $faker->randomElement(['Credit Card', 'Bank Transfer']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}