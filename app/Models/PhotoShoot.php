<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoShoot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_photo',
        'header_photo', 
        'date',
        'status',
        'category_id',
        'price',
        'location',
        'duration',
        'slug',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $table = 'photo_shoots';
}
