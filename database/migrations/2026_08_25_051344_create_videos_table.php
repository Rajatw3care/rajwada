<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            // 'gallery' = Video Gallery on the Gallery page, 'testimonial' = Video Testimonials on the Testimonials page
            $table->string('category')->default('gallery');
            $table->string('thumbnail');
            $table->string('title');
            $table->string('tag')->nullable();
            $table->string('duration')->nullable();
            $table->string('video_url');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
