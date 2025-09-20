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
    Schema::create('task_allocations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tasks_categories_id')->constrained()->onDelete('cascade');
        $table->string('main_keyword')->nullable();
        $table->integer('keyword_difficulty')->nullable();
        $table->mediumText('secondary_keywords')->nullable();
        $table->string('main_title')->nullable();
        $table->mediumText('keyword_photo')->nullable();
        $table->mediumText('suggested_topics')->nullable();
        $table->mediumText('suggested_subtopics')->nullable();
        $table->mediumText('copy_leaks')->nullable();

        $table->foreignId('writer_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('cascade');
        $table->foreignId('seo_engineer')->nullable()->constrained('users')->onDelete('cascade');


        $table->string('due_date')->nullable();

        $table->string('doc_link')->nullable();
        $table->integer('writer_count')->nullable();
        $table->integer('reviewer_count')->nullable();
        $table->mediumText('writer_notes')->nullable();
        $table->mediumText('reviewer_notes')->nullable();
        $table->boolean('seo_approved')->default(false);
        $table->enum('priority', ['high', 'low'])->nullable();
        $table->boolean('reviewed')->default(false);
        $table->enum('progress', ['pending', 'in_progress', 'done'])->nullable();
        $table->string('blog_link')->nullable();
        $table->integer('perfomance_score')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_allocations');
    }
};
