<?php

namespace Wzj\Push;

use Illuminate\Support\ServiceProvider;

class XMPushServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__ . '/config/xmpush.php' => config_path('xmpush.php')
        ], 'xmpush');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('xmpush', function ($app){
            return new XMPush();
        });
    }
}
