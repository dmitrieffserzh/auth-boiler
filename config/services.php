<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

	// Social auth
    'facebook' => [
	    'client_id' => env('FB_CLIENT_ID'),
	    'client_secret' => env('FB_CLIENT_SECRET'),
	    'redirect' => env('FB_REDIRECT')
    ],

    'vkontakte' => [
	    'client_id' => env('VKONTAKTE_KEY'),
	    'client_secret' => env('VKONTAKTE_SECRET'),
	    'redirect' => env('VKONTAKTE_REDIRECT_URI')
    ],
    'odnoklassniki' => [
	    'client_id' => env('ODNOKLASSNIKI_ID'),
	    'client_secret' => env('ODNOKLASSNIKI_SECRET'),
	    'client_public' => env('ODNOKLASSNIKI_PUBLIC'),
	    'redirect' => env('ODNOKLASSNIKI_REDIRECT'),
    ],
    'instagram' => [
	    'client_id' => env('INSTAGRAM_KEY'),
	    'client_secret' => env('INSTAGRAM_SECRET'),
	    'redirect' => env('INSTAGRAM_REDIRECT_URI')
    ],
];
