<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class SiteAnalyser
{
    public function getHttpError($url)
    {
        $response = Http::get($url);
        return $response->status();
    }
}