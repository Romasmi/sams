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
    private const telegramToken = '1129706097:AAGmMvWpz_iMsXEVO7lrU86msciZ4dZ2OiI';
    private const telegramChatId = '234499992';

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

    static function notifyByTelegram($text)
    {
        $response = Http::post('https://api.telegram.org/bot' . self::telegramToken . '/sendMessage', [
            'chat_id' => self::telegramChatId,
            'text' => $text,
            'parse_mode' => 'html'
        ]);
    }
}