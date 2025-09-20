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
        Schema::table('task_allocations', function (Blueprint $table) {
            //
            $table->enum('taskstatus', ['approved', 'rejected']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_allocations', function (Blueprint $table) {
            //
            $table->enum('taskstatus', ['approved', 'rejected']);
        });
    }
};
