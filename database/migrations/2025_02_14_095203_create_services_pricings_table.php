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
        Schema::create('services_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('services_id')->constrained('services')->references('id')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->boolean('isActie')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_pricings');
    }
};
