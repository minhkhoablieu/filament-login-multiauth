<?php

namespace Minhk\FilamentLoginMultiAuth\Filament\Pages;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Minhk\FilamentLoginMultiAuth\Facades\LoginMultiAuth;

class Login extends BaseLogin
{
    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getUserNameFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getUserNameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label(__('filament-login-multiauth::filament-login-multiauth.form.username.label'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        $username_column = LoginMultiAuth::getUsernameColumn($data['username']);

        return [
            $username_column => $data['username'],
            'password' => $data['password'],
        ];
    }
}
