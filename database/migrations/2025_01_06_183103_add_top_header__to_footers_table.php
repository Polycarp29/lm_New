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
        Schema::table('upper_about_sections', function (Blueprint $table) {
            //
            $table->string('top_header');
            $table->string('first_container_title');
            $table->mediumText('first_container_desc');
            $table->string('second_container_title');
            $table->mediumText('second_container_dec');
            $table->string('right_image');
            $table->string('left_header');
            $table->string('left_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upper_about_sections', function (Blueprint $table) {
            //
        });
    }
};
