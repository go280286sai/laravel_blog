<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

/**
 * @method static pluck(string $string)
 */
class Subscription extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;

    public static function add($email)
    {
        $sub = new static();
        $sub->email = $email;
        $sub->token = Str::random(100);
        $sub->save();

        return $sub;
    }

    public function remove(): ?bool
    {
        return $this->delete();
    }

    public static function unscriber($id)
    {
        $uns = new static();
        return $uns->where('unset', $id)->delete();
    }
}
