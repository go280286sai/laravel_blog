<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static where(string $string, int $id)
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'title', 'content'];

    public static function addMessage($request)
    {
        $message = new static();
        $message->fill($request);
        $message->save();

        return $message;
    }
}
