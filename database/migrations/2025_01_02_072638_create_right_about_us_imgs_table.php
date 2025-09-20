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
        Schema::create('right_about_us_imgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'homeaboutus_id')->constrained('home_about_us')->cascadeOnDelete();
            $table->string('right_image');
            $table->string('alt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('right_about_us_imgs');
    }
};
