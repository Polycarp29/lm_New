<?php

namespace App\Models;

use App\Models\HomeAboutUs;
use App\Models\RightAboutUsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUsConfig extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'isVisible',
    ];



    public function homeAboutUs()
    {
        return $this->hasMany(HomeAboutUs::class);
    }

    public function rightImage()
    {
        return $this->hasOne(RightAboutUsImg::class);
    }


}
