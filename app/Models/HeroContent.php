<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroContent extends Model
{
    protected $fillable = [
        'eyebrow', 'title', 'subtitle', 'main_image',
        'cta_1_label', 'cta_1_link', 'cta_2_label', 'cta_2_link',
    ];
}
