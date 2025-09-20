<?php

namespace App\Models\Task;

use App\Models\TaskInsurer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeeMarketingSOP extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'sop_content',
        'is_active',
        'task_insurers_id'
    ];


    // Relationship


    public function taskInsurers()
    {
        return $this->belongsTo(TaskInsurer::class);
    }
}
