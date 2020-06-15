<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\SiteAnalyser;
use App\Site;
use Illuminate\Support\Facades\Log;

class CheckSiteGoogleScore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public const name = 'CheckSiteHttpCode';
    protected $site;
    protected $page;
    protected $strategy;

    /**
     * Create a new job instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site, $page = '/', $strategy = 'mobile')
    {
        $this->site = $site;
        $this->page = $page;
        $this->strategy = $strategy;
    }

    /**
     * Execute the job.
     *
     * @param SiteAnalyser $siteAnalyser
     * @return void
     */
    public function handle()
    {
        SiteAnalyser::getGoogleScoring($this->site, $this->page, $this->strategy);
    }
}
