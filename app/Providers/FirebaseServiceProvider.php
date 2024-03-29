<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Firebase::class, function() {
              
            $json_file_path = config_path('firebase.json');
            $serviceAccount = ServiceAccount::fromJsonFile($json_file_path);

            return (new Factory())
                ->withServiceAccount($serviceAccount)
                ->create();  
        });

        $this->app->alias(Firebase::class, 'firebase');
    }
}
