<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_contents', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('main_image')->nullable();
            $table->string('cta_1_label')->nullable();
            $table->string('cta_1_link')->nullable();
            $table->string('cta_2_label')->nullable();
            $table->string('cta_2_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_contents');
    }
};
