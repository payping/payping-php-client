<?php
namespace  PayPing\Laravel;

use Illuminate\Support\ServiceProvider;


class PayPingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('Authorization', function () {
                $client_id = config('services.payping.client_id');
                $client_secret = config('services.payping.client_secret');
                $redirect = config('services.payping.redirect');
                return new \PayPing\Authorization($client_id,$client_secret,$redirect);
        });

        $this->app->singleton('Payment', function () {
            $token = config('services.payping.token');
            return new \PayPing\Payment($token);
        });
    }

    /**
     * Publish the plugin configuration.
     */
    public function boot()
    {
//
    }
}
