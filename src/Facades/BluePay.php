<?php

namespace BluePay\bluepay\Facades;

use Illuminate\Support\Facades\Facade;

class BluePay extends Facade
{
    protected static function getFacadeAccessor() 
    { 
    	return 'BluePay'; 
    }
}