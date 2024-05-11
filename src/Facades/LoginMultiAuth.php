<?php

namespace Minhk\FilamentLoginMultiAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getUsernameColumn(string $username)
 * @method static string generateUsername(string $email)
 */
class LoginMultiAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Minhk\FilamentLoginMultiAuth\LoginMultiAuth::class;
    }
}
