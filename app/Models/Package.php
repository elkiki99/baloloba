<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'basic_price',
        'extended_price',
        'before_basic_price',
        'before_extended_price',
        'description',
        'basic_features',
        'extended_features',
    ];

    protected $casts = [
        'basic_features' => 'array',
        'extended_features' => 'array',
        'basic_price' => 'decimal:2',
        'extended_price' => 'decimal:2',
        'before_basic_price' => 'decimal:2',
        'before_extended_price' => 'decimal:2',
    ];
}
