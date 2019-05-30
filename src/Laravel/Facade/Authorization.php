<?php


namespace PayPing\Laravel\Facade;

use Illuminate\Support\Facades\Facade;


class Authorization extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Authorization';
    }
}