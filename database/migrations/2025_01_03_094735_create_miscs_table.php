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
        Schema::create('miscs', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->integer('size')->default(2);
            $table->string('favicon');
            $table->integer('fav_size')->default(2);
            $table->string('brand_name')->default('Poltech Solutions');
            $table->mediumText('meta_description');
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('btn_color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miscs');
    }
};
