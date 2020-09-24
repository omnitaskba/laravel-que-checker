<?php

namespace Omnitask\LaravelQueChecker\Providers;

use Illuminate\Support\ServiceProvider;
use Omnitask\LaravelQueChecker\Console\Commands\CheckIsQueWorking;
use Omnitask\LaravelQueChecker\Console\Commands\CheckQue;
use Omnitask\LaravelQueChecker\Console\Commands\DeleteOldQueHeartbeats;

class LaravelQueCheckerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->app->register(EventServiceProvider::class);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravelqchecker.php',
            'laravelqchecker'
        );

        $this->registerCommands();
        $this->registerPublishing();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/laravelqchecker.php' => base_path('config/laravelqchecker.php'),
        ], 'config');
    }
    
    /**
     * Register the package's commands.
     *
     * @return void
     */

    private function registerCommands(){
        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckIsQueWorking::class,
                CheckQue::class,
                DeleteOldQueHeartbeats::class,
            ]);
        }
    }
}
