<?php

namespace Tender\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tender\Tender
 */
class Tender extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Tender\Tender::class;
    }
}
