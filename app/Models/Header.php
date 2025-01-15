<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Header extends Model
{
    use HasFactory;

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
