<?php

namespace Mawuekom\RequestCustomizer;

use Mawuekom\RequestCustomizer\BaseFormRequest;
use Mawuekom\RequestSanitizer\Traits\InputSanitizer;

/**
 * Abstract Class FormRequestCustomizer
 * 
 * @package Mawuekom\RequestCustomizer
 */
abstract class FormRequestCustomizer extends BaseFormRequest
{
    use InputSanitizer;
    
    /**
     * @var array
     */
    private $sanitizers;

    /**
     * Create new instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this ->sanitizers = $this ->sanitizers();
    }
    
    /**
     * Get sanitizers defined for form input
     *
     * @return array
     */
    abstract public function sanitizers(): array;
}
