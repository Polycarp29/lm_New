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
        Schema::create('s_e_o_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->foreignId('task_allocations_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('title')->nullable();
            $table->text('snippet')->nullable();
            $table->integer('rank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_e_o_analytics');
    }
};
