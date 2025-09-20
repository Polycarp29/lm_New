<?php

namespace App\Models;
use App\Models\User;
use App\Models\TaskCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'task_name',
        'task_link',
        'task_description',
        'misc',
        'due_date',
        'status',
        'completion_status',
        'isActive',
        'task_category_id',
        'user_id',
        'company_issuer',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('task_name', 'like', "%{$value}%")
        ->orWhere('company_issuer', 'like', "{$value}")
        ->orWhere('status', 'like', "{$value}");
    }

    public function pricings()
    {
        return $this->belongsTo(Pricing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function taskreview()
    {
        return $this->hasMany(TaskReview::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }


}
