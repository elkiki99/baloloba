<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientPhotoQuantity;
use App\Models\PhotoShoot;
use App\Models\User;

class ClientPhotoShoot extends Model
{
    protected $fillable = [
        'client_id',
        'photo_shoot_id',
        'photo_id',
        'quantity',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function photoShoot()
    {
        return $this->belongsTo(PhotoShoot::class, 'photo_shoot_id');
    }

    public function photoQuantities()
    {
        return $this->hasMany(ClientPhotoQuantity::class, 'client_photo_shoot_id');
    }
}
