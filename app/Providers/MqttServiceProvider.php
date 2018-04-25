<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MqttServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Mqtt', function ($app) {
            require 'vendor/zach2825/phpmqtt/phpMQTT.php';

            $mqtt = new \phpMQTT(config('mqtt.host'), config('mqtt.port', '1883'), 'work-box');

            if (!$mqtt->connect(true, NULL, config('mqtt.username'), config('mqtt.password'))) {
                throwException(new \Exception('Mqtt connection failed'));
            }

            return $mqtt;
        });
    }
}
