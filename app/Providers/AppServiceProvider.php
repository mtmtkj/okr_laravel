<?php

namespace App\Providers;

use App\InputPeriod;
use App\Services\Timeline;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     * @SuppressWarnings("unused")
     */
    public function boot()
    {
        Validator::extend('same_password', function ($attribute, $value, $parameters, $validator) {
            return !Hash::check($value, $parameters[0]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        $this->app->bind(Timeline::class, function () {
            return new Timeline(new InputPeriod());
        });
    }
}
