<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Events\SiteHttpCodeChecked;
use App\Site;

class SiteAnalyser
{
    static public function getHttpError(Site $site)
    {
        $response = Http::get($site->getUrl());
        event(new SiteHttpCodeChecked($site, $response->status()));
        return $response->status();
    }
}