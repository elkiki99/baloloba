<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoShoot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_photo',
        'status',
        'category_id',
        'price',
        'scheduled_at',
        'location',
        'duration',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
