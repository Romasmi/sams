<?php

namespace App\Events;

use App\GoogleScore;
use Illuminate\Queue\SerializesModels;
use App\Site;

class GoogleScoreChecked
{
    use SerializesModels;
    public $site;
    public $googleScore;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Site $site, GoogleScore $googleScore)
    {
        $this->site = $site;
        $this->googleScore = $googleScore;
    }
}
