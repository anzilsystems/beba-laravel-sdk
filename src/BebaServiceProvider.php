<?php

namespace AnzilSystems\Beba;

use AnzilSystems\Beba\BebaController;

use Illuminate\Support\Facades\AnzilSystems\Beba;
use Illuminate\Support\ServiceProvider;

class BebaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('beba',function(){

            return new \AnzilSystems\Beba\BebaController;
    
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
