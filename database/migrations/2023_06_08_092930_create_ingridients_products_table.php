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
        Schema::create('ingridients_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('ingridient_id');
            $table->float('quantity', 6,3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingridients_products');
    }
};
