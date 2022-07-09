<?php

namespace HossamMonir\Msegat;

use HossamMonir\Msegat\Services\MsegatFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class MsegatServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register a class in the service container
        $this->app->bind('Msegat', function () {
            return new MsegatFacade();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Msegat services config to the application config
        $this->publishes([
            __DIR__.'/config/msegat.php' => config_path('msegat.php'),
        ]);

        $loader = AliasLoader::getInstance();
        $loader->alias('Msegat', 'HossamMonir\\Msegat\\Facades\\Msegat');
    }
}
