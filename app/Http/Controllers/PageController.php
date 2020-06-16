<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Page;
use App\Providers\RouteServiceProvider;
use App\Model\Site;
use App\Model\SiteJobPeriod;
use Illuminate\Http\Request;

class PageController extends Controller
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
     * Add a new site instance.
     *
     * @param array $data
     * @return \App\Model\Site
     */
    protected function addPages(Request $request, $siteId)
    {
        $pages = $this->getPagesFromText($request->pages);
        $pages = $this->getPreparedPages($pages, $siteId);

        $count = count($pages);
        foreach ($pages as $page) {
            $pageInstance = Page::onlyTrashed()
                ->where([
                    'site_id' => $siteId,
                    'link' => $page
                ])->first();

            if ($pageInstance) {
                $pageInstance->restore();
            } else {
                Page::create([
                    'site_id' => $siteId,
                    'link' => $page
                ]);
            }
        }

        return response()->json(['status' => "Добавленов {$count} адресов."]);
    }

    protected function deletePage(Request $request, $id)
    {
        $page = Page::find($id);
        $page->delete();
        if ($page->trashed()) {
            $status = 'Запись удалена';
        } else {
            $status = 'Невозможно удалить';
        }
        return response()->json(['status' => $status]);
    }

    private function getPagesFromText($text)
    {
        $pages = [];
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $text) as $line) {
            $pages[] = trim($line);
        }
        return $pages;
    }

    public function getPreparedPages($pages, $siteId)
    {
        $site = Site::find($siteId);
        $domain = $site->domain;

        $preparedPages = [];
        foreach ($pages as $page) {
            $urlInfo = parse_url($page);
            if (isset($urlInfo['path']) && isset($urlInfo['host']) && $urlInfo['host'] == $domain) {
                $preparedPages[] = $urlInfo['path'];
            }
        }

        return $preparedPages;
    }
}
