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
            $table->id();
            $table->string('gPlusPlaceId', 255);
            $table->string('gPlusUserId', 255);
            $table->integer('rating');
            $table->string('reviewerName');
            $table->text('reviewText');
            $table->string('categories');
            $table->dateTime('reviewTime');
            $table->timestamps();
        
            $table->foreign('gPlusPlaceId')->references('gPlusPlaceId')->on('places')->onDelete('cascade');
            $table->foreign('gPlusUserId')->references('gPlusUserId')->on('reviewers')->onDelete('cascade');
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
