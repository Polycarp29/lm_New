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
        Schema::table('lee_marketing_s_o_p_s', function (Blueprint $table) {
            //
            $table->foreignId('task_insurers_id')->constrained('task_insurers')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lee_marketing_s_o_p_s', function (Blueprint $table) {
            //
        });
    }
};
