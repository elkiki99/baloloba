<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'description',
        'image',
        'button_text',
        'button_link',
    ];
}
