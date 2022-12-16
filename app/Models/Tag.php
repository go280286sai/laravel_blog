<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static pluck(string $string, string $string1)
 */
class Tag extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'post_tags',
            'tag_id',
            'post_id'
        );
    }

    /**
     * @return bool|null
     */
    public function remove(): ?bool
    {
        return $this->delete();
    }
}
