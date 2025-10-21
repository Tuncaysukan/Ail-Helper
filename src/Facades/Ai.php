<?php

namespace Tncy\AiHelper\Facades;

use Illuminate\Support\Facades\Facade;

class Ai extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ai';
    }
}