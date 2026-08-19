<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'avatar', 'message', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
