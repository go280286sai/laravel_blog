<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class TelegramClass
{
    public function __construct()
    {
    }

    public function sendMessage($message)
    {
        $date = date('Y-n-d G:i:s');
        $data = [
            'chat_id' => '-778339786',
            'text' => $message,
        ];
        $send = file_get_contents('https://api.telegram.org/bot'.env('TELEGRAM_API').'/sendMessage?'.
            http_build_query($data));
    }

    public function getRead()
    {
        $client = new Client();
        $answer = [];
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://api.telegram.org/'.env('TELEGRAM_API').'/getUpdates');
        $promise = $client->sendAsync($request)->then(function ($response) {
            $response->getBody();
        });
        $promise->wait();
    }
}
