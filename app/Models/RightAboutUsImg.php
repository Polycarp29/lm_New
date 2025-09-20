<?php

namespace App\Models;

use App\Models\AboutUsConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RightAboutUsImg extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'right_image',
        'alt',
        'about_us_config_id',
    ];



    public function aboutUsConf()
    {
        return $this->belongsTo(AboutUsConfig::class);
    }


}
