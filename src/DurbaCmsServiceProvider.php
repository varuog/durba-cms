<?php

namespace Varuog\DurbaCms;

use Illuminate\Support\ServiceProvider;

class DurbaCmsServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->publishes([
            __DIR__.'/Config/durba-cms.php' => config_path('durba-cms.php'),
            __DIR__.'/Database/seeders' => database_path('seeders'),
            __DIR__.'/Database/factories' => database_path('factories'),
        ]);
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'DurbaCms');

        $this->mergeConfigFrom(
            __DIR__.'/Config/durba-cms.php', 'durba-cms'
        );

        $this->app->bind('App\Services\Contracts\UserServiceInterface', config('durba-cms.service.user'));
        //dd('s');
    }
}
