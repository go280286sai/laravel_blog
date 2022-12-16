<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Comment extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return void
     */
    public function allow()
    {
        $this->status = 1;
        $this->save();
    }

    /**
     * @return void
     */
    public function disAllow()
    {
        $this->status = 0;
        $this->save();
    }

    /**
     * @return void
     */
    public function toggleStatus()
    {
        if ($this->status == 0) {
            return $this->allow();
        }

        return $this->disAllow();
    }

    /**
     * @return void
     */
    public function remove()
    {
        $this->delete();
    }
}
