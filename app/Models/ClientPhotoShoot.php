<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPhotoShoot extends Model
{
    protected $fillable = [
        'client_id',
        'photo_shoot_id',
        'photo_id',
        'quantity',
    ];

    // Relación con el cliente
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Relación con el PhotoShoot
    public function photoShoot()
    {
        return $this->belongsTo(PhotoShoot::class, 'photo_shoot_id');
    }

    // Relación con la foto
    public function photoQuantities()
    {
        return $this->hasMany(ClientPhotoQuantity::class, 'client_photo_shoot_id');
    }
}