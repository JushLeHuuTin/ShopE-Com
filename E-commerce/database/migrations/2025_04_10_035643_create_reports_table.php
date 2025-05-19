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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_report');
            $table->string('report_type', 50);
            $table->string('period', 20);
            $table->string('period_value', 20);
            $table->decimal('value', 15, 2)->default(0.00);
            $table->foreignId('id_user')->nullable()->constrained('users','id_user')->onDelete('set null');
            $table->foreignId('id_product')->nullable()->constrained('products','id_product')->onDelete('set null');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
