<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    use HasFactory;

    /**
     * @param  object  $fields
     * @return void
     */
    public static function add(object $fields): void
    {
        $telegram = new static();
        $last_id = static::latest()->get()[0]->message_id;
        foreach ($fields as $item) {
            if ($last_id < $item->message()->id()) {
                $telegram->update_id = $item->id();
                $telegram->message_id = $item->message()->id();
                $telegram->from_id = $item->message()->from()->id();
                $telegram->first_name = $item->message()->from()->firstname();
                $telegram->last_name = $item->message()->from()->lastname();
                $telegram->username = $item->message()->from()->username();
                $telegram->chat_id = $item->message()->chat()->id();
                $telegram->send_date = $item->message()->date();
                $telegram->text = $item->message()->text();
                $telegram->save();
            }
        }
    }

    /**
     * @param $id
     * @return void
     */
    public static function statusAnswer(int $id): void
    {
        $telegram = static::find($id);
        $telegram->status = 1;
        $telegram->save();
    }

    /**
     * @param  int  $id
     * @param  string  $answer
     * @return void
     */
    public static function setAnswer(int $id, string $answer): void
    {
        $telegram = static::find($id);
        $telegram->answer = $answer;
        $telegram->save();
    }

    /**
     * @param  int  $id
     * @return void
     */
    public static function remove(int $id): void
    {
        static::find($id)->delete();
    }
}
