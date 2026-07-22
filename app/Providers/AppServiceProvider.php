<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Enums\UserType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        // custom validation rule for filtering 
        Validator::extend('filter',function($_attribute,$value,$parameters){
            return !in_array(strtolower($value),$parameters);
        },'The :attribute is not allowed.');

        //paginator bootstrap 5
        Paginator::useBootstrapFive();

        // create admin gate
        Gate::define('admin',function($user){
            return $user->user_type ===UserType::Admin;
        });
    }
}
