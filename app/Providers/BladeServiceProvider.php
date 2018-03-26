<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        Blade::if('auth', function ($user = null) {
        	if(!$user && auth()->check()) {
        		$user = auth()->user();
	        }
	        
	        if(!$user) {
        		return false;
	        }
	        else {
        		return true;
	        }
        });
    }

    public function register()
    {
        //
    }
}
