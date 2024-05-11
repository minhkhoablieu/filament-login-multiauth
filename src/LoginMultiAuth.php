<?php

namespace Minhk\FilamentLoginMultiAuth;

class LoginMultiAuth
{
    public function getUsernameColumn($username): string
    {
        $username_column = config('filament-login-multiauth.username_column');

        return filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : $username_column;
    }

    public function generateUsername($email): string
    {

        $username = strstr($email, '@', true);

        return $username;
    }
}
