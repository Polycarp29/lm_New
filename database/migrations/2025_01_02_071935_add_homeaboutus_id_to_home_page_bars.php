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
        Schema::table('home_page_bars', function (Blueprint $table) {
            //
            $table->foreignId(column: 'homeaboutus_id')->constrained('home_about_us')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page_bars', function (Blueprint $table) {
            //
            $table->foreignId(column: 'homeaboutus_id')->constrained('home_about_us')->cascadeOnDelete();
        });
    }
};
