<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['photo', 'name', 'role', 'description', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
