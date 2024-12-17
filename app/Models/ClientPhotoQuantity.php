<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\ClientPhotoShoot;
use Illuminate\Database\Eloquent\Model;

class ClientPhotoQuantity extends Model
{
    protected $fillable = ['client_photo_shoot_id', 'photo_id', 'quantity'];

    // Relación con la tabla principal ClientPhotoShoot
    public function clientPhotoShoot()
    {
        return $this->belongsTo(ClientPhotoShoot::class, 'client_photo_shoot_id');
    }

    // Relación con la foto seleccionada
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }
}