<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Http\Interfaces\AuthenticationRepositoryInterface',
            'App\Http\Eloquent\AuthenticationRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\InvoicesRepositoryInterface',
            'App\Http\Eloquent\InvoicesRepository'
        );
    }
}
