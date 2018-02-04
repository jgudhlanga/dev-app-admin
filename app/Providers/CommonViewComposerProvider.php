<?php

namespace App\Providers;

use App\Http\Composers\CommonViewComposer;
use Illuminate\Support\ServiceProvider;

class CommonViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeCommonView();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    public function composeCommonView()
    {
    	view()->composer([
    		'layouts._partials.header',
		    'layouts._partials.sidebar',
		    'layouts._partials.footer'], CommonViewComposer::class);
    }
}
