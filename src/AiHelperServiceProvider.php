<?php

namespace Tncy\AiHelper;

use Illuminate\Support\ServiceProvider;

class AiHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ai.php', 'ai'
        );
        
        $this->app->singleton('ai', function ($app) {
            return new Services\AiManager($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ai.php' => config_path('ai.php'),
            ], 'config');
            
            $this->commands([
                Commands\AiTestCommand::class,
            ]);
        }
    }
}