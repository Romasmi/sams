<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Site;
use App\Services\SiteAnalyser;
use App\Jobs;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(SiteAnalyser $siteAnalyser)
    {
        $sites = Site::all()->sortByDesc('id');

/*        foreach ($sites as $site)
        {
            Jobs\CheckSiteGoogleScore::dispatch($site, '/', 'desktop')->onConnection('database');
            Jobs\CheckSiteGoogleScore::dispatch($site, '/', 'mobile')->onConnection('database');
        }*/


        return view('dashboard.index',
        [
                'title' => 'Список сайтов',
                'sites' => $sites
            ]);
    }

    public function addSite()
    {
        return view('dashboard.site.add',
            [
                'title' => 'Добавить сайт'
            ]);
    }
}



