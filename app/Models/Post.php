<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param $fields
     * @return static
     */
    public static function add($fields): static
    {
        $post = new static;
        $post->user_id = Auth::user()->id;
        $post->title = $fields['title'];
        $post->description = $fields['description'];
        $post->s_date = Carbon::createFromFormat('d/m/Y', $fields['s_date'])->format('Y-m-d');
        $post->content = $fields['content'];
        $post->slug = Str::of($fields['title'])->slug('-');
        $post->status = $fields['status'] ?? 0;
        $post->save();

        return $post;
    }

    /**
     * @param $fields
     * @return void
     */
    public function edit($fields): void
    {
        $post = new static;
        $post->title = $fields['title'];
        $post->description = $fields['description'];
        $post->s_date = Carbon::createFromFormat('F j, Y', $fields['s_date'])->format('Y-m-d');
        $post->content = $fields['content'];
        $post->slug = Str::of($fields['title'])->slug('-');
        $this->save();
    }

    /**
     * @return void
     */
    public function remove(): void
    {
        $this->removeImage();
        $this->delete();
    }

    /**
     * @return void
     */
    public function removeImage(): void
    {
        if ($this->image != null) {
            Storage::delete(env('USERS_IMG').$this->image);
        }
    }

    /**
     * @param $image
     * @return void
     */
    public function uploadImage($image): void
    {
        if ($image == null) {
            return;
        }
        Storage::delete('uploads/posts/'.$this->image);
        $filename = Str::random(10).'.'.$image->extension();
        $image->storeAs('uploads/posts', $filename);
        $this->image = $filename;
        $this->save();
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if ($this->image == null) {
            return '/uploads/posts/no-image.png';
        }

        return '/uploads/posts/'.$this->image;
    }

    /**
     * @param  int  $id
     * @return void
     */
    public function setCategory(int $id): void
    {
        if ($id == null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    /**
     * @param $ids
     * @return void
     */
    public function setTags($ids): void
    {
        if ($ids == null) {
            return;
        }
        $this->tags()->sync($ids);
    }

    /**
     * @return void
     */
    public function setDraft(): void
    {
        $this->status = 0;
        $this->save();
    }

    /**
     * @return void
     */
    public function setPublic(): void
    {
        $this->status = 1;
        $this->save();
    }

    /**
     * @param $value
     * @return void
     */
    public function toggleStatus()
    {
        if ($this->status == 1) {
            return $this->setDraft();
        }

        return $this->setPublic();
    }

    /**
     * @return void
     */
    public function setFeatured(): void
    {
        $this->is_featured = 1;
        $this->save();
    }

    /**
     * @return void
     */
    public function setStandart(): void
    {
        $this->is_featured = 0;
        $this->save();
    }

    /**
     * @param $value
     * @return void
     */
    public function toggleFeatured($value)
    {
        if ($value == null) {
            return $this->setStandart();
        }

        return $this->setFeatured();
    }

    /**
     * @param $value
     * @return void
     */
    public function setDateAttribute($value): void
    {
        $date = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    /**
     * @param $value
     * @return string
     */
    public function getDateAttribute($value): string
    {
        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');

        return $date;
    }

    /**
     * @return string
     */
    public function getCategoryTitle(): string
    {
        return ($this->category != null)
            ? $this->category->title
            : __('messages.no_category');
    }

    /**
     * @return string
     */
    public function getTagsTitles(): string
    {
        return (! $this->tags->isEmpty())
            ? implode(', ', $this->tags->pluck('title')->all())
            : __('messages.no_tags');
    }

    /**
     * @return null
     */
    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return Carbon::createFromFormat('Y-m-d', $this->s_date)->format('F j, Y');
    }

    /**
     * @return mixed
     */
    public function hasPrevious(): mixed
    {
        return self::where('id', '<', $this->id)->where('status', 1)->max('id');
    }

    /**
     * @return mixed
     */
    public function getPrevious(): mixed
    {
        $postID = $this->hasPrevious(); //ID

        return self::find($postID);
    }

    /**
     * @return mixed
     */
    public function hasNext(): mixed
    {
        return self::where('id', '>', $this->id)->where('status', 1)->min('id');
    }

    /**
     * @return mixed
     */
    public function getNext(): mixed
    {
        $postID = $this->hasNext();

        return self::find($postID);
    }

    /**
     * @return Collection
     */
    public function related(): Collection
    {
        return self::all()->where('user_id', '=', $this->user_id);
    }

    /**
     * @return bool
     */
    public function hasCategory(): bool
    {
        return $this->category != null ? true : false;
    }

    /**
     * @return mixed
     */
    public static function getPopularPosts(): mixed
    {
        return self::orderBy('views', 'desc')->take(3)->get();
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments()->where('status', 1)->get();
    }
}
