<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('/admin/home', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-home-slider', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-services', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-projects', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-about', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-contact', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-testimonials', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('/admin/manage-sosmeds', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });
    }
}
