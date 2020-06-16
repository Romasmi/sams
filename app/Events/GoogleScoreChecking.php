<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Model\GoogleScore;
use App\Model\Site;

class GoogleScoreChecking
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
