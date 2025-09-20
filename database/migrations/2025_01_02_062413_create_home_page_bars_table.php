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
        Schema::create('home_page_bars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('more_about_us_id')->constrained('more_home_about_us')->cascadeOnDelete();
            $table->string('header');
            $table->string('bars');
            $table->integer('priority');
            $table->string('percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_bars');
    }
};
