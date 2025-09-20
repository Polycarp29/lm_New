<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable  = [
        'task_id',
        'user_id',
        'amount',
        'status',
        'currency',
        'transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function task()
    {
        return  $this->belongsTo(Task::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('amount', 'like', "%{$value}%")
        ->orWhere('transaction_id', 'like', "{$value}")
        ->orWhere('status', 'like', "{$value}");
    }
}
