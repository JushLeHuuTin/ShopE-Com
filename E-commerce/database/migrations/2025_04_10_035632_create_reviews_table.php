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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->foreignId('id_user')->constrained('users','id_user')->onDelete('cascade');
            $table->foreignId('id_product')->constrained('products','id_product')->onDelete('cascade');
            $table->integer('rating')->nullable()->between(1, 5);
            $table->text('comment')->nullable();
            $table->string('status', 50)->default('approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
