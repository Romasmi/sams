<?php

namespace App\Listeners;

use App\Events\GoogleScoreChecked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Site;
use App\Model\GoogleScore;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SaveGoogleScore
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
     * @param GoogleScoreChecked $event
     * @return void
     */
    public function handle(GoogleScoreChecked $event)
    {
        $row = GoogleScore::where([
            'site_id' => $event->site->id,
            'strategy' => $event->googleScore->strategy,
            'page' => $event->googleScore->page])
            ->whereColumn('updated_at', 'created_at')
            ->orderByDesc('updated_at')
            ->limit(1)->first();

        $row->score = $event->googleScore->score;
        $row->save();

        $filename = "google_pi/{$row->id}.txt";
        Storage::disk('local')->put($filename, $event->googleScore->data);
    }
}
