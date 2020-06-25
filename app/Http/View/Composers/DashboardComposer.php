<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Model\Site;
use App\model\Page;

class DashboardComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sitesCount', Site::all()->count());
        $view->with('pagesCount', Page::all()->count());
    }
}