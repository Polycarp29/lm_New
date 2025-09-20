<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerBars extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'about_us_banner_id',
        'bar_string',
        'bar_description',
        'percentage',
    ];

    public function aboutUsBanner()
    {
        $this->belongsTo(AboutUsBanner::class);
    }
}
