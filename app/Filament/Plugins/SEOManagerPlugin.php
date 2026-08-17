<?php

namespace App\Filament\Plugins;

use App\Filament\Resources\SeoSettings\SeoSettingResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class SEOManagerPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-seo-manager';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                SeoSettingResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
