<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\SiteHttpCodeChecked' => [
            'App\Listeners\OnSiteHttpCodeChecked',
        ],
        'App\Events\GoogleScoreChecking' => [
            'App\Listeners\OnCheckingGoogleScore',
        ],
        'App\Events\GoogleScoreChecked' => [
            'App\Listeners\OnGoogleScoreChecked',
        ],
        'App\Events\MetricsFullUpdateStarting' => [
            'App\Listeners\OnMetricsFullUpdateStarting',
        ],
        'App\Events\MetricsFullUpdateFinished' => [
            'App\Listeners\OnMetricsFullUpdateFinished',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
