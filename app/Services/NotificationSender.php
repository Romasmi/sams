<?php

namespace App\Services;
use App\Model\GoogleScore;
use Illuminate\Support\Facades\Http;
use App\Events\SiteHttpCodeChecked;
use App\Events\GoogleScoreChecked;
use App\Events\GoogleScoreChecking;
use App\Model\Site;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Model\User;

class NotificationSender
{

    static function notifyByEmail($text, $title)
    {
/*        $user = Auth::user();*/
        $email = 'romasmi@ro.ru';
        Mail::raw($text, function($message) use ($email, $title)
        {
            $message->from('info@sams-service.ru', 'SAMS');
            $message->to($email)->subject($title);
        });
    }

    static function notifyByTelegram($text, $title)
    {

    }
}