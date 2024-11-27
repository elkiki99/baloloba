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
    ];

    public function photoShoot()
    {
        return $this->belongsTo(PhotoShoot::class, 'photoshoot_id');
    }
}
