<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Broadcast extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'name', 'avatar', 'date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addChat(array $fields)
    {
        $field = new self();
        $field->fill($fields);
        $field->save();
    }

    public static function getChat()
    {
        $field = self::all();
        if ($field->count() > 40) {
            self::removeChat();
        }

        return $field;
    }

    public static function removeChat()
    {
        for ($i = 0; $i < 40; $i++) {
            self::all()->first()->delete();
        }
    }
}
