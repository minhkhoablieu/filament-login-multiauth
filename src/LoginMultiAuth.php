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
        $user = $userModel::query()
            ->where($username_column, $username)
            ->first();
        return (bool)$user;
    }

    public function extractUsernameFromEmail($email): string
    {
        return explode('@', $email)[0];
    }

    public function extractDomainFromEmail($email): string
    {
        return explode('@', $email)[1];
    }
}
