<?php

namespace BluePay\bluepay;

use Illuminate\Support\ServiceProvider;

class BluePayServiceProvider extends ServiceProvider 
{
	public function boot()
	{
	}

	public function register()
	{
		$this->app->bind('BluePay', function() {
			return new BluePay();
		});
	}
}