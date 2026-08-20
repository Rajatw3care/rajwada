<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_contents', function (Blueprint $table) {
            $table->string('page_banner_image')->nullable()->after('cta_link');
            $table->longText('vision')->nullable()->after('page_banner_image');
            $table->longText('mission')->nullable()->after('vision');
            $table->string('core_values')->nullable()->after('mission');
        });
    }

    public function down(): void
    {
        Schema::table('about_contents', function (Blueprint $table) {
            $table->dropColumn(['page_banner_image', 'vision', 'mission', 'core_values']);
        });
    }
};
