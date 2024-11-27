<?php

namespace App\Models;

use App\Models\PhotoShoot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

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
