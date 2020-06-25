<?php

namespace App\Listeners;

use App\Events\GoogleScoreChecking;
use App\Events\MetricsFullUpdateStarting;
use App\Model\MetricsFullUpdate;
use App\Model\Site;

class OnMetricsFullUpdateStarting
{
    /**
     * Create the event listener.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GoogleScoreChecking  $event
     * @return void
     */
    public function handle(MetricsFullUpdateStarting $event)
    {
        MetricsFullUpdate::create([
            'site_id' =>  $event->site->id
        ]);
    }
}
