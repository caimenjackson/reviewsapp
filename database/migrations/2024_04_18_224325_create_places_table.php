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
        Schema::create('places', function (Blueprint $table) {
            $table->string('gPlusPlaceId')->primary();
            $table->string('name');
            $table->string('price')->nullable();
            $table->text('address')->nullable();
            $table->string('hours')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('closed');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
