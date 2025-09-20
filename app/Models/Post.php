<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'featured_post',
        'featured_image',
        'published_at',
        'status',
    ];


    // Create Reletionships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post__categories');
    }



    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'post_tags');
    }

    public function comments()
    {
       return  $this->hasMany(Comments::class);
    }

}
