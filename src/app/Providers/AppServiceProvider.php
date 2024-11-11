<?php

namespace App\Providers;

use App\Services\Password\PasswordHashService;
use App\Services\Password\PasswordHashServiceInterface;
use App\Services\User\RegisterUserService;
use App\Services\User\RegisterUserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: RegisterUserServiceInterface::class,
            concrete: RegisterUserService::class,
        );
        $this->app->singleton(
            abstract: PasswordHashServiceInterface::class,
            concrete: PasswordHashService::class,
        );
    }

    public function provides(): array
    {
        return [
            RegisterUserServiceInterface::class,
            PasswordHashServiceInterface::class,
        ];
    }
}
