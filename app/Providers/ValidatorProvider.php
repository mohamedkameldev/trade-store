<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Validator::extend('naming_filter', function ($attribute, $value, $params) {
            return !(in_array(strtolower($value), $params));
        }, "prohibited name");
    }
}
