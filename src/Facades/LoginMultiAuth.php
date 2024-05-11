<?php

namespace Minhk\FilamentLoginMultiAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getUsernameColumn(string $username)
 * @method static string generateUsername(string $email)
 * @method static bool checkUsernameAlreadyExists(string $username)
 * @method static string extractUsernameFromEmail(string $email)
 * @method static string extractDomainFromEmail(string $email)
 *
 * @see \Minhk\FilamentLoginMultiAuth\LoginMultiAuth
 */
class LoginMultiAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Minhk\FilamentLoginMultiAuth\LoginMultiAuth::class;
    }
}
