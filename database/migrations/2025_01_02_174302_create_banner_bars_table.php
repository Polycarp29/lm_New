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
        Schema::create('banner_bars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_banner_id')->constrained('about_us_banners')->cascadeOnDelete();
            $table->string('bar_string');
            $table->string('bar_description');
            $table->string('percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_bars');
    }
};
