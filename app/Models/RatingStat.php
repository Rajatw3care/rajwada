<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingStat extends Model
{
    protected $fillable = ['icon', 'number', 'label', 'sort_order'];
}
