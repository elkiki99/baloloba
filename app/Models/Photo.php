<?php

namespace App\Models;

use App\Models\PhotoShoot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_shoot_id',
        'filename',
    ];

    public function photoshoot()
    {
        return $this->belongsTo(PhotoShoot::class, 'photo_shoot_id');
    }
}
