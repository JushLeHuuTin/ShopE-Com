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
        Schema::create('cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->foreignId('id_user')->nullable()->constrained('user','id_user')->onDelete('set null');
            $table->string('session_id', 100)->nullable();
            $table->foreignId('id_variant')->constrained('product_variants','id_variant')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->dateTime('added_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
