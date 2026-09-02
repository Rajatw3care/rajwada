<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon', 'title', 'description', 'overview_image', 'overview_description',
        'sort_order', 'is_active', 'show_on_homepage',
    ];

    protected $casts = ['is_active' => 'boolean', 'show_on_homepage' => 'boolean'];
}
