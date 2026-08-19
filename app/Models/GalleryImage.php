<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['image', 'alt_text', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
