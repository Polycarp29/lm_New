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
        Schema::table('right_about_us_imgs', function (Blueprint $table) {
            //
            $table->dropForeign(['homeaboutus_id']); // Drop the foreign key
            $table->dropColumn('homeaboutus_id');   // Drop the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('right_about_us_imgs', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('homeaboutus_id'); // Recreate the column
            $table->foreign('homeaboutus_id')->references('id')->on('home_about_us'); // Recreate the foreign key
        });
    }
};
