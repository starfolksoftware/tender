<?php

namespace Tender\Tender\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tender\Tender\Tender
 */
class Tender extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Tender\Tender\Tender::class;
    }
}
