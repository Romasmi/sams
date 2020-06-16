<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Model\Site;

class SiteHttpCodeChecked
{
    use SerializesModels;
    public $site;
    public $httpCode;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Site $site, $httpCode)
    {
        $this->site = $site;
        $this->httpCode = $httpCode;
    }
}
