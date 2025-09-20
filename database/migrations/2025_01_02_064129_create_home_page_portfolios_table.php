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
        Schema::create('home_page_portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'homeaboutus_id')->constrained('home_about_us')->cascadeOnDelete();
            $table->string('top_header');
            $table->string('item_header');
            $table->mediumText('description');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_portfolios');
    }
};
