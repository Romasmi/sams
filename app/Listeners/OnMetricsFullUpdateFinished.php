<?php

namespace App\Listeners;

use App\Events\GoogleScoreChecking;
use App\Events\MetricsFullUpdateFinished;
use App\Events\MetricsFullUpdateStarting;
use App\Model\MetricsFullUpdate;
use App\Model\Site;

class OnMetricsFullUpdateFinished
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
    public function handle(MetricsFullUpdateFinished $event)
    {
        $metricFullUpdate = Site::find($event->site->id)->hasMany('App\Model\MetricsFullUpdate')
            ->latest()->first();
        $metricFullUpdate->touch();
        $metricFullUpdate->save();
    }
}
