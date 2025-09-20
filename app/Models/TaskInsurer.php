<?php

namespace App\Models;

use App\Models\Task\LeeMarketingSOP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskInsurer extends Model
{
    use HasFactory;


    protected $fillable = [
        'issuer_name',
    ];


    public function tasktype()
    {
        return $this->belongsToMany(TaskType::class, 'issurer_task_types', 'task_insurer_id', 'task_type_id');
    }


    public function taskBelongsTos()
    {
        return $this->hasMany(TaskBelongsTo::class, 'task_insurers_id');
    }


    public function leemarketingSOP()
    {
        return  $this->hasMany(LeeMarketingSOP::class);
    }
}
