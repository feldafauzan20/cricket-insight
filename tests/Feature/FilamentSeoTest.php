<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\SeoSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentSeoTest extends TestCase
{
    public function test_seo_settings_record_exists_with_sensible_defaults()
    {
        $setting = SeoSetting::getSettings();

        $this->assertNotNull($setting);
        $this->assertEquals('insightcricket.com', $setting->site_name);
        $this->assertEquals('Welcome to insightcricket.com — modern, fast, and SEO‑ready.', $setting->meta_description);
        $this->assertTrue($setting->enable_open_graph);
        $this->assertTrue($setting->enable_twitter_card);
        $this->assertTrue($setting->enable_json_ld);
        $this->assertTrue($setting->auto_schema_generation);
        $this->assertEquals('/images/default-og.png', $setting->og_image);
    }

    public function test_authenticated_user_can_access_seo_settings_in_filament_admin()
    {
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'email' => 'pci@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }

        $setting = SeoSetting::getSettings();

        // Index / List view
        $response = $this->actingAs($user)->get('/pci/seo-settings');
        $response->assertStatus(200);
        $response->assertSee('SEO Settings');
        $response->assertSee('insightcricket.com');

        // Edit form view
        $editResponse = $this->actingAs($user)->get("/pci/seo-settings/{$setting->id}/edit");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('General Meta Tags');
        $editResponse->assertSee('Open Graph');
        $editResponse->assertSee('Twitter Cards');
        $editResponse->assertSee('JSON-LD');
    }

    public function test_frontend_renders_seo_meta_tags_open_graph_twitter_and_json_ld()
    {
        $response = $this->get('/id');

        $response->assertStatus(200);
        // Meta tags
        $response->assertSee('<meta name="robots"', false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('Welcome to insightcricket.com — modern, fast, and SEO‑ready.', false);
        
        // Open Graph
        $response->assertSee('<meta property="og:site_name"', false);
        $response->assertSee('<meta property="og:title"', false);
        $response->assertSee('default-og.png', false);
        
        // Twitter Cards
        $response->assertSee('<meta name="twitter:card"', false);
        $response->assertSee('<meta name="twitter:title"', false);

        // JSON-LD Schema
        $response->assertSee('application/ld+json', false);
        $response->assertSee('schema.org', false);
        $response->assertSee('Organization', false);

        // Webmaster Verification
        $response->assertSee('<meta name="google-site-verification" content="1_8EBXxTjfBYjhqOm2f8gV6SDoQ8H8-9vZs8ELIwP8o">', false);
    }

    public function test_seo_settings_updates_reflect_immediately()
    {
        $setting = SeoSetting::getSettings();

        $setting->update([
            'site_name' => 'Cricket Insight Official',
            'schema_name' => 'Cricket Insight Official',
            'og_site_name' => 'Cricket Insight Official',
            'meta_description' => 'Updated meta description for testing.',
            'twitter_username' => 'cricket_live',
        ]);

        $this->assertEquals('Cricket Insight Official', SeoSetting::first()->site_name);

        $response = $this->get('/id');
        $response->assertStatus(200);
        $response->assertSee('Updated meta description for testing.', false);
        $response->assertSee('Cricket Insight Official', false);
        $response->assertSee('@cricket_live', false);

        // Reset to original default
        $setting->update([
            'site_name' => 'insightcricket.com',
            'schema_name' => 'insightcricket.com',
            'og_site_name' => 'insightcricket.com',
            'meta_description' => 'Welcome to insightcricket.com — modern, fast, and SEO‑ready.',
            'og_image' => '/images/default-og.png',
            'twitter_username' => 'insightcricket',
        ]);
    }
}
