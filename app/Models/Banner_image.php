<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner_image extends Model
{
    use HasFactory;

    protected $fillable = ['about_us_banner_id', 'banner_image', 'alt'];


    public function aboutUsBanner()
    {
        $this->belongsTo(AboutUsBanner::class);
    }


}

