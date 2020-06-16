<?php

namespace App\Listeners;

use App\Events\SiteHttpCodeChecked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Site;
use App\Model\SiteHttpCode;

class SaveSiteHttpCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Site $site)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SiteHttpCodeChecked  $event
     * @return void
     */
    public function handle(SiteHttpCodeChecked $event)
    {
        SiteHttpCode::create([
            'http_code' => $event->httpCode,
            'site_id' =>  $event->site->id,
        ]);
    }
}
