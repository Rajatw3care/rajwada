<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'avatar', 'message', 'event_label', 'rating', 'sort_order', 'is_active', 'is_featured'];

    protected $casts = ['is_active' => 'boolean', 'is_featured' => 'boolean', 'rating' => 'integer'];
}
