<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('overview_image')->nullable()->after('description');
            $table->text('overview_description')->nullable()->after('overview_image');
            $table->boolean('show_on_homepage')->default(true)->after('is_active');
        });

        Schema::table('gallery_images', function (Blueprint $table) {
            $table->string('title')->nullable()->after('alt_text');
            $table->string('category')->nullable()->after('title');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('category')->nullable()->after('venue');
            $table->string('tags')->nullable()->after('category');
            $table->boolean('is_featured')->default(false)->after('is_active');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('event_label')->nullable()->after('message');
            $table->unsignedTinyInteger('rating')->default(5)->after('event_label');
            $table->boolean('is_featured')->default(false)->after('rating');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['overview_image', 'overview_description', 'show_on_homepage']);
        });

        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn(['title', 'category']);
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['category', 'tags', 'is_featured']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['event_label', 'rating', 'is_featured']);
        });
    }
};
