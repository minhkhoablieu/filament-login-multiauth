<?php

namespace Minhk\FilamentLoginMultiAuth;

use Illuminate\Support\Str;

class LoginMultiAuth
{
    public function getUsernameColumn($username): string
    {
        $username_column = config('filament-login-multiauth.username_column');

        return filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : $username_column;
    }

    public function generateUsername($email): string
    {
        $username = $this->extractUsernameFromEmail($email);

        if ($this->checkUsernameAlreadyExists($username)) {
            $username = $username . $this->extractDomainFromEmail($email);
        }
        return $username;
    }

    public function checkUsernameAlreadyExists($username): bool
    {
        $username_column = config('filament-login-multiauth.username_column');
        $userModel = config('filament-login-multiauth.model');

        return $userModel::query()
            ->where($username_column, $username)
            ->exists();
    }

    public function extractUsernameFromEmail($email): string
    {
        return Str::before($email, '@');
    }

    public function extractDomainFromEmail($email): string
    {
        return Str::after($email, '@');
    }
}
