<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.pivot', function( $view )
        {
            $contact = \App\Contact::first();
            $sosmeds = \App\Sosmed::all();
            
            $view->with( ['footerContact' => $contact, 'footerSosmeds' => $sosmeds] );
        });
    }
}
