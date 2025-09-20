<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'description',
    ];

    // Relationships

    public function bannerImage()
    {
        return $this->hasOne(Banner_image::class);

    }


    public function bannerBars()
    {
        return $this->hasMany(BannerBars::class);
    }
}
