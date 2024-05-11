# Login With Email Or Username (In One Field)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/minhk/filament-login-multiauth.svg?style=flat-square)](https://packagist.org/packages/minhk/filament-login-multiauth)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require minhk/filament-login-multiauth 
```

This is the contents of the published config file:

```php
return [
    'table_name' => 'users',
    'username_column' => 'username',
    'model' => 'App\\Models\\User',
];
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-login-multiauth-config"
```

If you don't have a username column in users' table, you can publish the migration file and migrate it:

```bash
php artisan vendor:publish --tag="filament-login-multiauth-migrations"
php artisan migrate
```

If you want to generate username by email, you can run command:

```bash
php artisan generate:username --all-user=true

or 

php artisan generate:username your-email@email.com
```

## Usage

Register the `Minhk\FilamentLoginMultiauth\FilamentLoginMultiauthServiceProvider` plugin in the panel provider
file.

```php
use Minhk\FilamentLoginMultiAuth\LoginMultiAuthPlugin;


public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LoginMultiAuthPlugin::make(),
        ]);
}
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [minhkhoablieu](https://github.com/minhkhoablieu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
