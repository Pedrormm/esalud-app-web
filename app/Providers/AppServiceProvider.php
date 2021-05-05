<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        Paginator::useBootstrap();
        // Using view composer to set the following variables globally
        view()->composer('*',function($view) {
            $view->with('user', Auth::user());
            $view->with('flagsMenuEnabled', getAuthValueFromPermission());
        });
        // Config::set(['permissions' => fillPermissionClass()]);
        // Config::set(['roles' => fillRolesClass()]);
        // Blade::include('inc.react', 'react');

        // Validator::extend('not_exists', function($attribute, $value, $parameters)
        // {
        //     return DB::table($this->tableName)
        //         ->where($this->column, '<>', $value)
        //         ->count()<1;
        // });


    }
}
