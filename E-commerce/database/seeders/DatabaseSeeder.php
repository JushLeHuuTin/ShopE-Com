<?php

namespace Database\Seeders;

use Database\Seeders\UserSeeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\CartSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductVariantSeeder;
use Database\Seeders\SessionSeeder;
use Database\Seeders\DiscountSeeder;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\InvoiceDetailSeeder;
use Database\Seeders\ReviewSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,           
            AddressSeeder::class,            
            Session::class, 
            Category::class, 
            Product::class,     
            Product_Variant::class, 
            CartSeeder::class, 
            DiscountSeeder::class,   
            InvoiceSeeder::class,
            InvoiceDetailSeeder::class,
            ReviewSeeder::class,
        ]);
        
        $this->call([
            ProductSeeder::class
        ]);
    }
}
