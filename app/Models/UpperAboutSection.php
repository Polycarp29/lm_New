<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpperAboutSection extends Model
{
    use HasFactory;


    protected $fillable = [
        'top_header',
        'first_container_title',
        'first_container_desc',
        'second_container_title',
        'second_container_dec',
        'right_image',
        'left_header',
        'left_description'
    ];
}
