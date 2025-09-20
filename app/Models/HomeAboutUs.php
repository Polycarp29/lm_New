<?php

namespace App\Models;

use App\Models\AboutUsConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeAboutUs extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'header',
        'icon',
        'description',
        'about_us_config_id',

    ];

    public function aboutUsConfig()
    {
        return $this->belongsTo(AboutUsConfig::class, 'about_us_config_id');
    }
}
