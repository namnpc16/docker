<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Category\CateRepository;
use App\Repositories\Category\CateRepositoryInterface;
use App\Repositories\Post\PostInterface;
use App\Repositories\Post\PostRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CateRepositoryInterface::class,
            CateRepository::class,
            PostInterface::class,
            PostRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
