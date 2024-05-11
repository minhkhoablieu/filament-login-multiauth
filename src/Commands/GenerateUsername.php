<?php

namespace Minhk\FilamentLoginMultiAuth\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Minhk\FilamentLoginMultiAuth\Facades\LoginMultiAuth;
use Minhk\FilamentLoginMultiAuth\Services\UpdateUsernameForUserService;

class GenerateUsername extends Command
{
    protected $signature = 'generate:username  {--all-user=false} {email?}';

    protected $description = 'Generate a username based on the provided email address';

    private UpdateUsernameForUserService $updateUsernameForUserService;

    private string $usernameColumn;

    public function __construct(UpdateUsernameForUserService $updateUsernameForUserService)
    {
        parent::__construct();

        $this->updateUsernameForUserService = $updateUsernameForUserService;
        $this->usernameColumn = config('filament-login-multiauth.username_column');
    }

    public function handle(): void
    {

        /** @var ?Model $userModel */
        $userModel = config('filament-login-multiauth.model');

        $isChangeAllUser = $this->option('all-user') === 'true';

        if ($isChangeAllUser) {
            $users = $userModel::query()
                ->whereNull($this->usernameColumn)
                ->get();
        } else {
            $email = $this->argument('email') ?? $this->ask('Enter an email address');
            $users = $userModel::query()
                ->where('email', $email)
                ->whereNull($this->usernameColumn)
                ->get();
        }

        if ($users->isEmpty()) {
            $this->info('No user found');
            return;
        }

        $users->each(function ($user) {
            $username = LoginMultiAuth::generateUsername($user->email);
            $this->updateUsernameForUserService->handle($user, $username);
            $this->info("Username for {$user->email} is {$username}");
        });

    }
}
