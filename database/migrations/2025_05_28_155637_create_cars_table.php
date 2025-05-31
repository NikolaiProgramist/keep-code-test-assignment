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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->decimal('full_price', 11, 4);
            $table->decimal('rental_price', 11, 4);
            $table->string('name', 255);
            $table->string('brand', 255);
            $table->string('color', 50);
            $table->string('transmission', 9);
            $table->string('fuel', 50);
            $table->integer('power');
            $table->boolean('purchased')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
