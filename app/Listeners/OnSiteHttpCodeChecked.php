<?php

namespace App\Listeners;

use App\Events\SiteHttpCodeChecked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Site;
use App\Model\SiteHttpCode;
use App\Services;

class OnSiteHttpCodeChecked
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Site $site)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SiteHttpCodeChecked  $event
     * @return void
     */
    public function handle(SiteHttpCodeChecked $event)
    {
        $metrica = SiteHttpCode::create([
            'http_code' => $event->httpCode,
            'site_id' =>  $event->site->id,
        ]);

        if ($metrica->http_code != 200)
        {
            $site = Site::find($event->site->id);
            $message = "
            <b>Сайт: {$site->domain}</b>
            Код ответа: {$metrica->http_code}
            Дата определения: {$metrica->updated_at}
        ";

            //Services\NotificationSender::notifyByEmail($message, "SAMS - httpCode {$site->domain}");
            Services\NotificationSender::notifyByTelegram($message);
        }
    }
}


