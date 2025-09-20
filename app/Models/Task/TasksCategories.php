<?php

namespace App\Models\Task;

use App\Models\TaskType;
use App\Models\TaskBelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TasksCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'task_description',
        'isActive',
        'date_month',
    ];

    public function taskallocation()
    {
        return $this->hasMany(TaskAllocation::class, 'tasks_categories_id');
    }



    public function tasktypes()
    {
        return $this->belongsToMany(TaskType::class, 'task_blog_categories', 'task_categories_id', 'task_type_id');
    }



    public function taskBelongsTos()
    {
        return $this->hasMany(TaskBelongsTo::class, 'task_categories_id');
    }
}
