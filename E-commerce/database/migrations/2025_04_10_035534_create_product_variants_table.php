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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('id_variant');
            $table->foreignId('id_product')
            ->constrained('products','id_product')
            ->onDelete('cascade');
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->string('size', 20);
            $table->string('color', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
