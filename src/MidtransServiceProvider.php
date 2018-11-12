<?php

namespace Pw\Midtrans;

use Illuminate\Support\ServiceProvider;
use Pw\Midtrans\Midtrans;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred
     */
    protected $defer = true;

    /**
     * Config path of midtrans packages
     */
    private $config_path = __DIR__ . '/../config/midtrans.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->config_path => config_path('midtrans.php'),
        ], 'lara-midtrans');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config_path, 'midtrans');
        $this->registerMidtrans();
    }

    public function registerMidtrans()
    {
        $this->app->singleton('Midtrans', function ($app) {
            return new Midtrans($this->app['config']['midtrans.server_key'], $this->app['config']['midtrans.is_production']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Midtrans'];
    }
}
