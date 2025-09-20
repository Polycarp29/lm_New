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
        Schema::create('more_home_about_us', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'homeaboutus_id')->constrained('home_about_us')->cascadeOnDelete();
            $table->string('header');
            $table->mediumText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('more_home_about_us');
    }
};
