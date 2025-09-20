<?php

namespace App\Models\Analytics;

use App\Models\Task\TaskAllocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEOAnalytics extends Model
{
    use HasFactory;

    protected $fillable  = [
        'url', 'task_allocations_id', 'title', 'keyword', 'snippet', 'rank',
    ];


    public function taskallocation()
    {
        return $this->belongsTo(TaskAllocation::class, 'task_allocations_id');
    }
}
