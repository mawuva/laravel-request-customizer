<?php

namespace Mawuekom\LaravelRequestCustomizer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mawuekom\LaravelRequestCustomizer\Skeleton\SkeletonClass
 */
class LaravelRequestCustomizerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-request-customizer';
    }
}
