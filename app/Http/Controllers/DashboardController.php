<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Services\SiteAnalyser;

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
            $url = "https://{$site->domain}";
            $site->httpCode = $siteAnalyser->getHttpError($url);
        }*/

        return view('dashboard.main',
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
