<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalServiceProvider extends ServiceProvider
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
        require_once app_path() . '/Core/Libraries/FunctionGlobals.php';
        require_once app_path() . '/Core/Libraries/FunctionLocals.php';
    }
}
