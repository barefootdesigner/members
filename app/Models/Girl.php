<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Girl extends Model
{
    protected $guarded = [];

    protected $casts = [
        'availability' => 'array',
        'gallery_images' => 'array',
        'services' => 'array', // Added
        'is_active' => 'boolean',
    ];
}
