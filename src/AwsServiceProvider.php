<?php

namespace Aws\Laravel;

//REMOVE DOWNGRADED
//use Aws\Sdk;
//use Illuminate\Foundation\Application as LaravelApplication;
//use Illuminate\Support\ServiceProvider;
//use Laravel\Lumen\Application as LumenApplication;
//END REMOVE DOWNGRADED


use Aws\Common\Aws;
use Illuminate\Support\ServiceProvider;

/**
 * AWS SDK for PHP service provider for Laravel applications
 */
class AwsServiceProvider extends ServiceProvider
{
    //REMOVE DOWNGRADED
    //const VERSION = '3.1.0';
    //END REMOVE DOWNGRADED

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__).'/config/aws.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('aws.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('aws');
        }

        $this->mergeConfigFrom($source, 'aws');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aws', function ($app) {
            $config = $app->make('config')->get('aws');
            
            //REMOVE DOWNGRADED
            //return new Sdk($config);
            //END REMOVE DOWNGRADED

            if (isset($config['config_file'])) {
                $config = $config['config_file'];
            }

            return Aws::factory($config);            
        });

        //REMOVE DOWNGRADED
        //$this->app->alias('aws', 'Aws\Sdk');
        //END REMOVE DOWNGRADED

        $this->app->alias('aws', 'Aws\Common\Aws');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //REMOVE DOWNGRADED
        //return ['aws', 'Aws\Sdk'];
        //END REMOVE DOWNGRADED

        return ['aws', 'Aws\Common\Aws'];
    }

}
