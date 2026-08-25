<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'venue', 'excerpt', 'body', 'category', 'tags',
        'sort_order', 'is_active', 'is_featured', 'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (BlogPost $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title).'-'.Str::random(5);
            }
        });
    }
}
