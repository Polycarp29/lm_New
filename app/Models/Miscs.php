<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miscs extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'logo',
        'size',
        'favicon',
        'fav_size',
        'brand_name',
        'meta_description',
        'primary_color',
        'secondary_color',
        'btn_color',
        'services_description',
        'about_us_description',
        'join_us_seo',
        'blog_seo',
    ];
}
