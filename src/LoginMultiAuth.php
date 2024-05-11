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
        $data = explode('@', $email);
        $username = $data[0];

        if ($this->CheckUsernameAlreadyExists($username)) {
            $username = $username . $data[1];
        }
        return $username;
    }

    public function CheckUsernameAlreadyExists($username): bool
    {
        $username_column = config('filament-login-multiauth.username_column');
        $userModel = config('filament-login-multiauth.model');
        $user = $userModel::query()
            ->where($username_column, $username)
            ->first();
        return (bool)$user;
    }
}
