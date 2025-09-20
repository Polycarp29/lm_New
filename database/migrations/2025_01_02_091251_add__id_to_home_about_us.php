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
        Schema::table('home_about_us', function (Blueprint $table) {
            //
            $table->foreignId('about_us_configs_id')->constrained('about_us_configs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_about_us', function (Blueprint $table) {
            //
            $table->foreignId('about_us_configs_id')->constrained('about_us_configs')->cascadeOnDelete();
        });
    }
};
