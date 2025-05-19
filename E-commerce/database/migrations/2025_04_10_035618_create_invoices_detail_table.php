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
        Schema::create('invoices_detail', function (Blueprint $table) {
            $table->id('id_invoice_detail');
            $table->foreignId('id_invoice')->constrained('invoices','id_invoice')->onDelete('cascade');
            $table->foreignId('id_variant')->constrained('product_variants','id_variant')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_detail');
    }
};
