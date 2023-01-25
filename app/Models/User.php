<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

/**
 * @method static pluck(string $string)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'birthday',
        'phone',
        'gender_id',
        'myself',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
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
        $user = new self();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = bcrypt($fields['password']);
        $user->save();

        return $user;
    }

    /**
     * @param $fields
     * @param $id
     * @return object
     */
    public static function edit($fields, $id): object
    {
        $user = User::find($id);
        $user->name = $fields['name'];
        $user->birthday = $fields['birthday'] ?? null;
        $user->phone = $fields['phone'] ?? null;
        $user->gender_id = $fields['gender_id'] ?? null;
        $user->myself = $fields['myself'] ?? null;
        if (!empty($fields['password'])) {
            $user->password = bcrypt($fields['password']);
        }
        $user->save();

        return $user;
    }

    /**
     * @param $password
     * @return void
     */
    public function generatePassword($password): void
    {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    /**
     * @return void
     */
    public function remove(): void
    {
        $this->delete();
    }

    /**
     * @param $image
     * @return void
     */
    public function uploadAvatar($image): void
    {
        if ($image != null) {
            Storage::delete('uploads/users' . $this->image);
            $fileName = Str::random(10) . '.' . $image->extension();
            $image->storeAs('uploads/users', $fileName);
            $this->avatar = $fileName;
            $this->save();
        } else {
            return;
        }
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        if ($this->avatar == null) {
            return '/uploads/users/no-user-image.png';
        }

        return '/uploads/users/' . $this->avatar;
    }
//
//    /**
//     * @return void
//     */
//    public function makeAdmin(): void
//    {
//        $this->is_admin = 1;
//        $this->save();
//    }

//    /**
//     * @return void
//     */
//    public function makeNormal(): void
//    {
//        $this->is_admin = 0;
//        $this->save();
//    }

    /**
     * @param $value
     * @return null
     */
    public function toggleAdmin($value)
    {
        if ($value == null) {
            $this->is_admin = 0;
            $this->save();
        }

        $this->is_admin = 1;
        $this->save();
    }


    /**
     * @param $value
     * @return object
     */
    public function toggleBan($value): object
    {
        if ($value == 0) {
            $this->status = 1;
            $this->save();
            return $this;
        }

        $this->status = 0;
        $this->save();
        return $this;
    }
}
