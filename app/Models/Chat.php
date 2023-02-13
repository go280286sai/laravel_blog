<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Models\TelegraphChat as BaseModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Chat extends BaseModel
{
    /**
     * @param  string  $message
     * @return void
     */
    public static function sendMessage(string $message): void
    {
        $chat = TelegraphChat::find(1);
        $chat->html($message)->send();
    }

    /**
     * @param  $image
     * @return void
     */
    public static function sendPhoto($image): void
    {
        $fileName = Str::random(10).'.'.$image->extension();
        $image->storeAs('uploads/send', $fileName);
        $chat = TelegraphChat::find(1);
        $chat->html('hello')->send();
        $chat->photo(Storage::path('uploads/send/'.$fileName))->send();
        Storage::delete($fileName);
    }

    /**
     * @param  object  $file
     * @return void
     */
    public static function sendDocument(object $file): void
    {
        $name = Storage::put('uploads/doc', $file);
        $chat = TelegraphChat::find(1);
        $chat->document($name)->send();
        Storage::delete($name);
    }

    /**
     * @return mixed
     */
    public static function getMessages(): mixed
    {
        $chat = TelegraphBot::find(1);
        return $chat->updates();
    }

    /**
     * @param $id
     * @return void
     */
    public static function removeMessage(int $id): void
    {
        $chat = TelegraphChat::find(2);
        $chat->deleteMessage($id)->send();
    }
}
