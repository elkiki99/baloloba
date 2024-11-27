<?php

namespace App\Models;

use App\Models\PhotoShoot;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'description'
    ];

    public function photoshoots()
    {
        return $this->hasMany(PhotoShoot::class);
    }
}
