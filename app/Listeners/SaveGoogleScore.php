<?php

namespace App\Listeners;

use App\Events\GoogleScoreChecked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Site;
use App\Model\GoogleScore;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\NotificationSender;

class SaveGoogleScore
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
     * @param GoogleScoreChecked $event
     * @return void
     */
    public function handle(GoogleScoreChecked $event)
    {
        $metrica = GoogleScore::where([
            'site_id' => $event->site->id,
            'strategy' => $event->googleScore->strategy,
            'page' => $event->googleScore->page])
            ->whereColumn('updated_at', 'created_at')
            ->orderByDesc('updated_at')
            ->limit(1)->first();

        $metrica->score = $event->googleScore->score;
        $metrica->save();

        $filename = "google_pi/{$metrica->id}.json";
        Storage::disk('local')->put($filename, $event->googleScore->data);

        $normalizedScore = $metrica->score * 100;
        if ($normalizedScore < 60)
        {
            $recommendation = 'Необходимо срочно заняться производительностью сайта.';
        }
        elseif ($normalizedScore < 80)
        {
            $recommendation = 'В ближайшее время необходимо заняться производительностью сайта.';
        }
        elseif ($normalizedScore < 85)
        {
            $recommendation = 'Отличный показатель, но можно лучше.';
        }
        else
        {
            $recommendation = 'C сайтом всё в порядке.';
        }

        $site = Site::find($event->site->id);
        $message = "
            <b>Показатели скорости GPSI</b>
            Сайт: {$site->domain}
            <a href=\"{$site->protocol}://{$site->domain}{$metrica->page}\">перейти</a>
            Страница {$metrica->page}
            Тип: {$metrica->strategy}
            Значение: {$normalizedScore} / 100
            {$recommendation}
        ";

        Log::info($message);

        //Services\NotificationSender::notifyByEmail($message, "SAMS - httpCode {$site->domain}");
        NotificationSender::notifyByTelegram($message);
    }
}
