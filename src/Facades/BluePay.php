<?php

namespace Margules\bplib\Facades;

use Illuminate\Support\Facades\Facade;

class BluePay extends Facade
{
    protected static function getFacadeAccessor() 
    { 
    	return 'BluePay'; 
    }
}