<?php

namespace App\Models;

use App\Models\Task\TasksCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskBelongsTo extends Model
{
    use HasFactory;


    protected $fillable = [
        'task_types_id',
        'task_insurers_id',
        'task_categories_id',
    ];

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_types_id');
    }

    public function taskInsurer()
    {
        return $this->belongsTo(TaskInsurer::class, 'task_insurers_id');
    }

    public function taskCategory()
    {
        return $this->belongsTo(TasksCategories::class, 'task_categories_id');
    }
}
