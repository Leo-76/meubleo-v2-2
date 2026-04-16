<?php

declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:admin')]
class AdminCommand extends Command
{
    protected $signature = 'meubleo:admin
                            {name?   : The name of the admin user}
                            {email?  : The email of the admin user}
                            {password? : The password of the admin user}';

    protected $description = 'Create or update an admin user for Meubleo';

    public function handle(): void
    {
        $name     = $this->argument('name')     ?? $this->ask('Name');
        $email    = $this->argument('email')    ?? $this->ask('Email');
        $password = $this->argument('password') ?? $this->secret('Password');

        $userModel = config('meubleo.user_model', \App\Models\User::class);

        $user = $userModel::updateOrCreate(
            ['email' => $email],
            [
                'name'     => $name,
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );

        $action = $user->wasRecentlyCreated ? 'created' : 'updated';

        $this->info("Admin user {$action}: {$email}");
    }
}
