<?php

namespace App\Listeners;

use App\Events\GoogleScoreChecked;
use App\Events\GoogleScoreChecking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Site;
use App\Model\GoogleScore;

class OnCheckingGoogleScore
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
     * @param  GoogleScoreChecking  $event
     * @return void
     */
    public function handle(GoogleScoreChecking $event)
    {
        GoogleScore::create([
            'site_id' =>  $event->site->id,
            'page' => $event->googleScore->page,
            'strategy' => $event->googleScore->strategy,
        ]);
    }
}
