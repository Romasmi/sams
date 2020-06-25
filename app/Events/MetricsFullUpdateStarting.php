<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Model\Site;

class MetricsFullUpdateStarting
{
    use SerializesModels;
    public $site;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }
}
