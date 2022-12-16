<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
//
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return Response|bool
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        if (Auth::check() && Auth::user()->email_verified_at) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id ? true : abort(403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return Response|bool
     */
    public function delete(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return Response|bool
     */
    public function restore(User $user, Post $post)
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return Response|bool
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
