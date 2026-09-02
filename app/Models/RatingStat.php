<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingStat extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'number', 'label', 'sort_order'];
}
