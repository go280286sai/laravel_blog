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

    /**
     * @param $email
     * @return static
     */
    public static function add($email): static
    {
        $sub = new self();
        $sub->email = $email;
        $sub->token = Str::random(100);
        $sub->save();

        return $sub;
    }

    /**
     * @return bool|null
     */
    public function remove(): ?bool
    {
        return $this->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function unscriber($id): mixed
    {
        $uns = new self();

        return $uns->where('unset', $id)->delete();
    }
}
