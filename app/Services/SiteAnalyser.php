<?php

namespace App\Services;
use App\Model\GoogleScore;
use Illuminate\Support\Facades\Http;
use App\Events\SiteHttpCodeChecked;
use App\Events\GoogleScoreChecked;
use App\Events\GoogleScoreChecking;
use App\Model\Site;
use Illuminate\Support\Facades\Log;

class SiteAnalyser
{
    const GOOGLE_PI_API_KEY = 'AIzaSyDrkI9fUBe1E2FUXoNo6yBbcDLbum9hMNs';
    const GOOGLE_PI_API_URL = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed';

    static public function getHttpError(Site $site)
    {
        $response = Http::get($site->getUrl());
        event(new SiteHttpCodeChecked($site, $response->status()));
        return $response->status();
    }

    static public function getGoogleScoring(Site $site, $page = '/', $strategy = 'mobile')
    {
        $googleScore = new GoogleScore();
        $googleScore->page = $page;
        $googleScore->strategy = $strategy;

        event(new GoogleScoreChecking($site, $googleScore));

        if ($page[0] != '/')
        {
            $page = '/' . $page;
        }

        $link = $site->getUrl() . $page;

        $request = self::GOOGLE_PI_API_URL .
            '?key=' .
            self::GOOGLE_PI_API_KEY .
            "&url={$link}&strategy={$strategy}&category=performance";
        $jsonResponse = Http::get($request);
        $response = json_decode($jsonResponse);
        $score = $response->lighthouseResult->categories->performance->score;

        $googleScore->score = $score;
        $googleScore->data = $jsonResponse;

        event(new GoogleScoreChecked($site, $googleScore));

        return $score;
    }
}