<?php

namespace Minhk\FilamentLoginMultiAuth;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Minhk\FilamentLoginMultiAuth\Filament\Pages\Login;

class LoginMultiAuthPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'login-multi-auth';
    }

    public function register(Panel $panel): void
    {
        $panel->login(Login::class);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
