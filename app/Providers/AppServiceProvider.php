<?php
declare(strict_types=1);

namespace App\Providers;

use App\Domain\Entity\User;
use App\Domain\Repositories\UserRepository;
use App\Domain\Services\ImageService;
use App\Domain\Services\UserService;
use App\Infrastructure\RepositoryImplements\UserRepositoryImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepositoryImplement(
                $app->make(User::class)
            );
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                $app->make(UserRepository::class),
                $app->make(ImageService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
