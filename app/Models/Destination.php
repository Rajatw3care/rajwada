<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'count_label', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
