<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_category_id',
        'task_id',
        'unit_price',
        'currency',
    ];


    public function taskcategory()
    {
        return $this->hasOne(TaskCategory::class);
    }


    public function tasks()
    {
        return $this->hasOne(Task::class);
    }
}
