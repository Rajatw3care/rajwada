<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            if (! Schema::hasColumn('blog_posts', 'share_facebook_url')) {
                $table->string('share_facebook_url')->nullable()->after('published_at');
            }
            if (! Schema::hasColumn('blog_posts', 'share_twitter_url')) {
                $table->string('share_twitter_url')->nullable()->after('share_facebook_url');
            }
            if (! Schema::hasColumn('blog_posts', 'share_whatsapp_url')) {
                $table->string('share_whatsapp_url')->nullable()->after('share_twitter_url');
            }
            if (! Schema::hasColumn('blog_posts', 'share_email_url')) {
                $table->string('share_email_url')->nullable()->after('share_whatsapp_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $columns = array_filter(
                ['share_facebook_url', 'share_twitter_url', 'share_whatsapp_url', 'share_email_url'],
                fn ($column) => Schema::hasColumn('blog_posts', $column)
            );

            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
