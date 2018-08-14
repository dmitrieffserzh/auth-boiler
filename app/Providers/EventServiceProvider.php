<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
	        // add your listeners (aka providers) here
	        'SocialiteProviders\\VKontakte\\VKontakteExtendSocialite@handle',
	        'SocialiteProviders\\Instagram\\InstagramExtendSocialite@handle',
	        \JhaoDa\SocialiteProviders\Odnoklassniki\OdnoklassnikiExtendSocialite::class,
        ],
    ];

    public function boot() {
        parent::boot();
	    Event::listen(['news.show'] , 'App\Events\ViewPostHandler');
        //
    }
}
