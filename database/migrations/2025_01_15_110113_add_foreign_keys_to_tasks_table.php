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
        Schema::table('tasks', function (Blueprint $table) {
            // Add missing columns if they don't exist
            $table->unsignedBigInteger('task_category_id');
            $table->unsignedBigInteger('user_id');

            // Add foreign key constraints
            $table->foreign('task_category_id')->references('id')->on('task_categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['task_category_id']);
            $table->dropForeign(['user_id']);

            // Drop the columns if rolling back
            $table->dropColumn(['task_category_id', 'user_id']);
        });
    }
};

