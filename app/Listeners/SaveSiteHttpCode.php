<?php

namespace App\Listeners;

use App\Events\SiteHttpCodeChecked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Site;
use App\Model\SiteHttpCode;
use App\Services;

class SaveSiteHttpCode
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

        $site = Site::find($event->site->id);
        $message = "
          <h1>Информация</h1>
          <ul>
            <li>Сайт: {$site->domain}</li>
            <li>Код ответа: {$metrica->http_code}</li>
            <li>Дата определения: {$metrica->updated_at}</li>
          </ul>
        ";

        //Services\NotificationSender::notifyByEmail($message, "SAMS - httpCode {$site->domain}");
        Services\NotificationSender::notifyByTelegram($message, "SAMS - httpCode {$site->domain}");
    }
}
