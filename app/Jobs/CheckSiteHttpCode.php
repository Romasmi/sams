<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\SiteAnalyser;
use App\Model\Site;
use Illuminate\Support\Facades\Log;

class CheckSiteHttpCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public const name = 'CheckSiteHttpCode';
    protected $site;

    /**
     * Create a new job instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Execute the job.
     *
     * @param SiteAnalyser $siteAnalyser
     * @return void
     */
    public function handle()
    {
        SiteAnalyser::getHttpError($this->site);
    }
}
