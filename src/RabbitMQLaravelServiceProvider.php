<?php

namespace Kontoulis\RabbitMQLaravel;

use App\Services\Consts\LoggerChannels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Kontoulis\RabbitMQLaravel\Exception\BrokerException;

/**
 * Class RabbitMQLaravelServiceProvider
 * @package Kontoulis\RabbitMQLaravel
 */
class RabbitMQLaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->publishes([
		    __DIR__.'/config.php' => base_path('config/rabbitmq-laravel.php'),
	    ]);


    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

	    $this->app->singleton('Kontoulis\RabbitMQLaravel\RabbitMQ', function ($app) {
			$config = $app['config']->get("rabbitmq-laravel");
			try{
                return new RabbitMQ($config);
            }catch (BrokerException $exception){
			    Log::channel(LoggerChannels::CONTAINER_LOG)
                    ->info('can not to connect to rabbit', ['exception'=>$exception->getMessage()]);
			    return new FakeRabbitMQ($config);
            }
	    });
	    
    }
}
