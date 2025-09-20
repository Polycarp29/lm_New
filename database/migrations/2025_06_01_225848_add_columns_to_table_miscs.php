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
        Schema::table('miscs', function (Blueprint $table) {
            //
            $table->mediumText('services_description')->nullable();
            $table->mediumText('about_us_description')->nullable();
            $table->mediumText('join_us_seo')->nullable();
            $table->mediumText('blog_seo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('miscs', function (Blueprint $table) {
            //
        });
    }
};
