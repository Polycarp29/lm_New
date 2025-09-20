<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Task;
use App\Models\TaskReview;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Task\TaskAllocation;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\UserActivities\ChatMessages;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id', 'google_token', 'google_refresh_token',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    // Include Access



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_seen_at' => 'datetime',
    ];


    // Define Relationships

    public function accountdetails()
    {
        return $this->hasOne(AccountDetails::class);
    }


    public function userdetails()
    {
        return $this->hasOne(UserProfiles::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function taskreview()
    {
        return $this->hasMany(TaskReview::class);
    }


    public function chats()
    {
        return $this->hasMany(ChatMessages::class, 'user_id');
    }


    public function isOnline()
    {
        return $this->last_seen_at && $this->last_seen_at->gt(now()->subMinutes(2));
    }


    public function taskAllocation()
    {
        return $this->hasMany(TaskAllocation::class, 'writer_id');
    }
}
