<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['category', 'thumbnail', 'title', 'tag', 'duration', 'video_url', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
