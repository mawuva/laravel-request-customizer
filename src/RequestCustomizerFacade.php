<?php

namespace Mawuekom\RequestCustomizer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mawuekom\RequestCustomizer\Skeleton\SkeletonClass
 */
class RequestCustomizerFacade extends Facade
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
