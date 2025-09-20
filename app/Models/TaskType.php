<?php

namespace App\Models;

use App\Models\Task\TaskAllocation;
use App\Models\Task\TasksCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
    ];

    public function taskinsurer()
    {
        return $this->belongsToMany(TaskInsurer::class, 'issurer_task_types',  'task_type_id', 'task_insurer_id');
    }

    public function taskcategories()
    {
        return $this->belongsToMany(TasksCategories::class, 'task_blog_categories', 'task_type_id', 'task_categories_id');
    }



    public function taskBelongsTos()
    {
        return $this->hasMany(TaskBelongsTo::class, 'task_types_id');
    }
}
