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

//    /**
//     * @return void
//     */
//    public function allow(): void
//    {
//        $this->status = 1;
//        $this->save();
//    }

//    /**
//     * @return void
//     */
//    public function disAllow(): void
//    {
//        $this->status = 0;
//        $this->save();
//    }

    /**
     * @return object
     */
    public function toggleStatus(): object
    {
        if ($this->status == 0) {
            $this->status = 1;
            $this->save();
            return $this;
        }
        $this->status = 0;
        $this->save();
        return $this;
    }

    /**
     * @return void
     */
    public function remove(): void
    {
        $this->delete();
    }
}
