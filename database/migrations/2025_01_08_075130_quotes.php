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
        //
        Schema::create('quotes', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('fname');
            $table->string('lname');
            $table->mediumText('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
