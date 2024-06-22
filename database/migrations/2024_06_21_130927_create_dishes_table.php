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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('dish_name');
            $table->text('dish_description'); 
            $table->string('dish_category');
            $table->decimal('dish_price', 8, 2); 
            $table->string('image')->nullable(); // Add the image column
            $table->string('status')->default('Nav pieejams'); // Add the status column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
