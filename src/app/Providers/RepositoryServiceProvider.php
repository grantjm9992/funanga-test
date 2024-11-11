<?php

namespace App\Providers;

use App\Models\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: UserRepositoryInterface::class,
            concrete: UserRepository::class,
        );
    }

    public function provides(): array
    {
        return [
            UserRepositoryInterface::class,
        ];
    }
}
