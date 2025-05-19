<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name', 100);
            $table->foreignId('id_category')
            ->nullable()
            ->nullable()
            ->constrained('categories','id_category')
            ->onDelete('set null');
            $table->boolean('is_featured')->default(0);
            $table->text('description')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};