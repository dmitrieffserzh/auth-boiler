<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public function boot() {
	    Carbon::setLocale('ru');
    }

    public function register() {
        //
    }
}
