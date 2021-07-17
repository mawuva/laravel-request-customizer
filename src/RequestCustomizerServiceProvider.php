<?php

namespace Mawuekom\RequestCustomizer;

use Illuminate\Support\ServiceProvider;

class RequestCustomizerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this ->app ->register('Mawuekom\FormRequest\FormRequestServiceProvider');
    }
}
