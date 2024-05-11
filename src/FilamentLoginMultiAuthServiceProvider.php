<?php

namespace Minhk\FilamentLoginMultiAuth;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentLoginMultiAuthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-login-multiauth')
            ->hasConfigFile()
            ->hasMigration('add_username_to_users_table')
            ->hasTranslations()
            ->hasCommands([
                Commands\GenerateUsername::class,
            ]);

    }
}
