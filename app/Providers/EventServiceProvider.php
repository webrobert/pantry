<?php

namespace App\Providers;

use App\Listeners\SetCurrentTeamIdInSession;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
	    Login::class => [
			SetCurrentTeamIdInSession::class
	    ]
    ];

    public function boot()
    {
        //
    }
}
