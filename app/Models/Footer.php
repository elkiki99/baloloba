<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    /** @use HasFactory<\Database\Factories\FooterFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'address',
        'phone',
        'email',
        'linkedin',
        'instagram',
    ];
}
