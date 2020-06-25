<?php

namespace App\Http\Controllers;

use App\Events\MetricsFullUpdateFinished;
use App\Events\MetricsFullUpdateStarting;
use App\Http\Controllers\Controller;
use App\Model\GoogleScore;
use App\Model\Page;
use App\Providers\RouteServiceProvider;
use App\Model\Site;
use App\Model\SiteJobPeriod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
use App\Jobs;

class SiteController extends Controller
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
     * Where to redirect users adding site.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function index(Request $request, $id)
    {
        $site = Site::find($id);
        $jobPeriods = [];
        foreach ($site->jobPeriods as $period) {
            $jobPeriods[$period->job] = SiteJobPeriod::getPeriodName($period->period);
        }
        $site->jobPeriods = $jobPeriods;

        $filter = new \stdClass();
        $filter->dateFrom = $request->dateFrom ?? '2020-01-01';
        $filter->dateTo = $request->dateTo ?? date('Y-m-d', time());
        $filter->limit = $request->limit ?? 15;

        $site->stat = $this->getGoogleScoreStat($site->id, $filter);

        return view('dashboard.site.index',
            [
                'title' => "Статистика сайта - {$site->name}",
                'site' => $site,
                'filter' => $filter
            ]);
    }

    /**
     * Show the adding site page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addSite()
    {
        return view('dashboard.site.add',
            [
                'title' => 'Добавить сайт'
            ]);
    }

    /**
     * Show the editing site page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editSite($id)
    {
        $site = Site::find($id);
        $jobPeriods = [];
        foreach ($site->jobPeriods as $period) {
            $jobPeriods[$period->job] = $period->period;
        }
        $site->jobPeriods = $jobPeriods;

        return view('dashboard.site.edit',
            [
                'title' => 'Редактировать сайт',
                'site' => $site
            ]);
    }

    /**
     * Add a new site instance.
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(Request $request)
    {
        $siteId = Site::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'protocol' => $request->protocol
        ])->id;

        foreach ($request->jobPeriod as $key => $value) {
            SiteJobPeriod::create([
                'site_id' => $siteId,
                'job' => $key,
                'period' => $value
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Edit site instance.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(Request $request, $id)
    {
        $site = Site::find($id);

        $site->name = $request->name;
        $site->domain = $request->domain;
        $site->protocol = $request->protocol;

        foreach ($request->jobPeriod as $key => $value) {
            SiteJobPeriod::where(['site_id' => $site->id, 'job' => $key])->update(['period' => $value]);
        }

        $site->save();

        return response()->json(['status' => 'Информация о сайте обновлена']);
    }

    protected function metricsFullUpdate(Request $request)
    {
        $site = Site::find($request->siteId);
        event(new MetricsFullUpdateStarting($site));

        Jobs\CheckSiteHttpCode::dispatch($site)->onConnection('database');
        Jobs\CheckSiteGoogleScore::dispatch($site, '/', 'desktop')->onConnection('database');
        Jobs\CheckSiteGoogleScore::dispatch($site, '/', 'mobile')->onConnection('database');
        foreach ($site->pages as $page) {
            Jobs\CheckSiteGoogleScore::dispatch($site, $page->link, 'desktop')->onConnection('database');
            Jobs\CheckSiteGoogleScore::dispatch($site, $page->link, 'mobile')->onConnection('database');
        }
        dispatch(function () use ($site) {
            event(new MetricsFullUpdateFinished($site));
        })->onConnection('database');

        return response()->json(['status' => "Обновление всех метрик сайта '{$site->name}' запущено"]);
    }

    private function getGoogleScoreStat($siteId, $filter)
    {
        $site = Site::find($siteId);

        $pagesStat = [];

        $mainPage = new Page();
        $mainPage->link = '/';
        $mainPage->site_id = $site->id;

        $pages = $site->pages;
        $pages->prepend($mainPage);

        $limit = $filter->limit ?? 15;
        $from = $filter->dataFrom ?? '2020-01-01';
        $to = $filter->dataTo ?? date('Y-m-d', time());

        foreach ($pages as $page) {
            $pageStat['mobile'] = DB::table('google_scores')->where(['site_id' => $site->id, 'strategy' => 'mobile', 'page' => $page->link])
                ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
                ->selectRaw('created_at AS date, score')
                ->orderByDesc('created_at')->limit($limit)->get();
            $pageStat['desktop'] = DB::table('google_scores')->where(['site_id' => $site->id, 'strategy' => 'desktop', 'page' => $page->link])
                ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
                ->selectRaw('created_at AS date, score')
                ->orderByDesc('created_at')->limit($limit)->get();
            $pagesStat[] = [
                'url' => $page->link,
                'stat' => $this->prepareGoogleScoreStatForChart($pageStat)
            ];
        }

        return $pagesStat;
    }

    private function prepareGoogleScoreStatForChart($stat)
    {
        $statForChart = [];

        if (count($stat['desktop'])) {
            foreach ($stat['desktop'] as $item) {
                $statForChart['label'][] = $item->date;
                $statForChart['data']['desktop'][] = $item->score;
            }
            foreach ($stat['mobile'] as $item) {
                $statForChart['data']['mobile'][] = $item->score;
            }
            $statForChart['label'] = array_reverse($statForChart['label']);
            $statForChart['data']['mobile'] = array_reverse($statForChart['data']['mobile']);
            $statForChart['data']['desktop'] = array_reverse($statForChart['data']['desktop']);
        }

        return json_encode($statForChart);
    }
}
