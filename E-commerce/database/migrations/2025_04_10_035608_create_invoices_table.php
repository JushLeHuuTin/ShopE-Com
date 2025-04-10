<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('id_invoice');
            $table->foreignId('id_user')->nullable()->constrained('user','id_user')->onDelete('set null');
            $table->foreignId('id_discount')->nullable()->constrained('discount_codes','id_discount')->onDelete('set null');
            $table->decimal('total_amount', 10, 2);
            $table->dateTime('invoice_date');
            $table->string('status', 50)->default('pending');
            $table->string('cancellation_reason', 255)->nullable();
            $table->enum('payment_method', ['Momo', 'COD', 'Credit Card', 'Bank Transfer', 'E-Wallet'])->default('COD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
