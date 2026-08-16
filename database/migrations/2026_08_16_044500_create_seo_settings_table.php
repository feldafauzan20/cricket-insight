<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();

            // General Meta Tags
            $table->string('site_name')->default('Cricket Insight');
            $table->string('title_suffix')->default(' | Cricket Insight');
            $table->string('homepage_title')->default('Cricket Insight - Premier Cricket News & Tournament Updates');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('enable_canonical_link')->default(true);
            $table->string('robots_default')->default('max-snippet:-1,max-image-preview:large,max-video-preview:-1');
            $table->string('author_default')->default('Cricket Insight Team');
            $table->string('favicon')->nullable();

            // Open Graph Settings
            $table->boolean('enable_open_graph')->default(true);
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');
            $table->string('og_site_name')->nullable();

            // Twitter Cards Settings
            $table->boolean('enable_twitter_card')->default(true);
            $table->string('twitter_card_type')->default('summary_large_image');
            $table->string('twitter_username')->default('cricketinsight');
            $table->string('twitter_creator')->nullable();

            // JSON-LD Schema.org Structured Data
            $table->boolean('enable_json_ld')->default(true);
            $table->boolean('auto_schema_generation')->default(true);
            $table->string('schema_type')->default('Organization');
            $table->string('schema_name')->nullable();
            $table->string('schema_url')->nullable();
            $table->string('schema_logo')->nullable();
            $table->text('schema_description')->nullable();
            $table->longText('custom_json_ld')->nullable();

            // Webmaster & Tracking Verification
            $table->string('google_site_verification')->nullable();
            $table->string('bing_site_verification')->nullable();

            $table->timestamps();
        });

        // Insert default record
        DB::table('seo_settings')->insert([
            'site_name' => 'Cricket Insight',
            'title_suffix' => ' | Cricket Insight',
            'homepage_title' => 'Cricket Insight - Premier Cricket News & Tournament Updates',
            'meta_description' => 'Stay updated with Cricket Insight for live cricket scores, latest tournament schedules, rankings, match news, and in-depth analytical insights.',
            'meta_keywords' => 'cricket, cricket insights, match schedules, tournament news, player rankings, live scores, ball by ball',
            'canonical_url' => null,
            'enable_canonical_link' => true,
            'robots_default' => 'max-snippet:-1,max-image-preview:large,max-video-preview:-1',
            'author_default' => 'Cricket Insight Team',
            'favicon' => '/favicon.ico',
            'enable_open_graph' => true,
            'og_title' => 'Cricket Insight',
            'og_description' => 'Stay updated with Cricket Insight for live cricket scores, latest tournament schedules, rankings, match news, and in-depth analytical insights.',
            'og_image' => 'images/logo/cricket-insight-logo-blue.webp',
            'og_type' => 'website',
            'og_site_name' => 'Cricket Insight',
            'enable_twitter_card' => true,
            'twitter_card_type' => 'summary_large_image',
            'twitter_username' => 'cricketinsight',
            'twitter_creator' => '@cricketinsight',
            'enable_json_ld' => true,
            'auto_schema_generation' => true,
            'schema_type' => 'Organization',
            'schema_name' => 'Cricket Insight',
            'schema_url' => 'https://cricketinsight.com',
            'schema_logo' => 'images/logo/cricket-insight-logo-blue.webp',
            'schema_description' => 'Cricket Insight is a premier cricket platform delivering breaking news, match schedules, and deep cricket analytics.',
            'custom_json_ld' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
