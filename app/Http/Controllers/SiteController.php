<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Site;
use App\SiteJobPeriod;
use Illuminate\Http\Request;

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
        //$site->jobPeroids = SiteJobPeriod::where('site_id', $site->id);
        $jobPeriods = [];
        foreach ($site->jobPeriods as $period)
        {
            $jobPeriods[$period->job] = $period->period;
        }

        return view('dashboard.site.edit',
            [
                'title' => 'Редактировать сайт',
                'site' => $site,
                'jobPeriods' => $jobPeriods
            ]);
    }

    /**
     * Add a new site instance.
     *
     * @param  array  $data
     * @return \App\Site
     */
    protected function create(Request $request)
    {
        $userId = Site::create([
            'name' => $request->name,
            'domain' =>  $request->domain,
            'protocol' =>  $request->protocol
        ])->id;

        foreach ($request->jobPeriod as $key => $value )
        {
            SiteJobPeriod::create([
                'site_id' => $userId,
                'job' =>  $key,
                'period' =>  $value
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Edit site instance.
     *
     * @param  array  $data
     * @return \App\Site
     */
    protected function update(Request $request, $id)
    {
        $site = Site::find($id);

        $site->name = $request->name;
        $site->domain = $request->domain;
        $site->protocol = $request->protocol;

        foreach ($request->jobPeriod as $key => $value )
        {
            SiteJobPeriod::where(['site_id' => $site->id, 'job' => $key])->update(['period' => $value]);
        }

        $site->save();

        return response()->json(['status' => 'Информация о сайте обновлена']);
    }
}
