<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_form_header',
        'content',
        'description',
        'footer_copyright',
        'botton_desc',
        'contacts',
        'isvisible',
    ];
}
