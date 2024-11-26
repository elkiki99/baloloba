<?php

namespace App\Models;

use App\Models\PhotoShoot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photoshoot_id',
        'filename',
        'caption',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function photoshoot()
    {
        return $this->belongsTo(PhotoShoot::class);
    }
}
