<?php

namespace Minhk\FilamentLoginMultiAuth\Services;

class UpdateUsernameForUserService
{
    private string $usernameColumn;

    public function __construct()
    {
        $this->usernameColumn = config('filament-login-multiauth.username_column');
    }

    /**
     * @throws \Exception
     */
    public function handle($user, $username): void
    {
        try {
            $user->{$this->usernameColumn} = $username;
            $user->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

}
