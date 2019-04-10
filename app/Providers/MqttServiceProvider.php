<?php

namespace App\Providers;

require '/var/www/home-controller-laravel/vendor/zach2825/phpmqtt/src/PhpMQTT.php';

use Illuminate\Support\ServiceProvider;
use PhpMQTT\PhpMQTT;

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

            $mqtt = new PhpMQTT(config('mqtt.host'), config('mqtt.port', '1883'), 'work-box');

            if (!$mqtt->connect(true, NULL, config('mqtt.username'), config('mqtt.password'))) {
                throwException(new \Exception('Mqtt connection failed'));
            }

            return $mqtt;
        });
    }
}
