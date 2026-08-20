<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'heading', 'body', 'image_1', 'image_2', 'image_3',
        'badge_image', 'cta_label', 'cta_link',
        'page_banner_image', 'vision', 'mission', 'core_values',
    ];
}
