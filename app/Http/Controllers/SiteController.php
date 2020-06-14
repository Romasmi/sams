<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Site;
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
     * Add a new site instance.
     *
     * @param  array  $data
     * @return \App\Site
     */
    protected function create(Request $request)
    {
        Site::create([
            'name' => $request->name,
            'domain' =>  $request->domain,
            'protocol' =>  $request->protocol
        ]);

        return redirect()->route('dashboard');
    }
}
