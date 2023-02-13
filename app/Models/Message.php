<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static find(int $id)
 * @method static where(string $string, int $id)
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'title', 'content'];

    /**
     * @param $request
     * @return static
     */
    public static function addMessage($request): static
    {
        $message = new self();
        $message->fill($request);
        $message->save();

        return $message;
    }

    /**
     * @return void
     */
    public static function remove(): void
    {
        Message::all()->where('status', 1)->delete();

    }
}
