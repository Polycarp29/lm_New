<?php

namespace App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskAllocation extends Model
{
    use HasFactory;


    protected $fillable = [
        'tasks_categories_id',
        'main_keyword',
        'keyword_difficulty',
        'secondary_keywords',
        'main_title',
        'keyword_photo',
        'suggested_topics',
        'suggested_subtopics',
        'copy_leaks',
        'writer_id',
        'reviewer_id',
        'seo_engineer',
        'due_date',
        'doc_link',
        'writer_count',
        'reviewer_count',
        'writer_notes',
        'reviewer_notes',
        'seo_approved',
        'priority',
        'reviewed',
        'progress',
        'blog_link',
        'perfomance_score',
        'taskstatus',
        'seo_analysis',
        'content',
        'plagrism_image',
        'is_task_submitted',
    ];


    public function taskcategory()
    {
        return $this->belongsTo(TasksCategories::class, 'tasks_categories_id');
    }


    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function seo()
    {
        return $this->belongsTo(User::class, 'seo_engineer');
    }

}
