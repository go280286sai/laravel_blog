<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Post;
use App\Models\Telegram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages._sidebar', function ($view) {
            $view->with('popularPosts', Post::getPopularPosts());
            $view->with('featuredPosts', Post::where('is_featured', 1)->take(3)->get());
            $view->with('recentPosts', Post::where('status', 1)->orderBy('s_date', 'desc')->take(4)->get());
            $view->with('categories', Category::all());
        });

        view()->composer('admin.layouts', function ($view) {
            if (Auth::user()->is_admin) {
                $telegrams = Telegram::where('status', 0)->count();

                return $view->with(['telegrams_count' => $telegrams]);
            }
        });
        view()->composer('admin.layouts', function ($view) {
            if (Auth::user()->is_admin) {
                $comments = DB::select('SELECT count(comments.status) as status FROM comments INNER JOIN posts
                                              on comments.post_id=posts.id where posts.deleted_at is NULL
                                              AND comments.deleted_at is null and comments.status=0;');
                $mail = Message::all()->where('status', '=', 0)->count();

                return $view->with(['newCommentsCount' => $comments[0]->status, 'mail_count' => $mail]);
            } else {
                $comments = DB::select('SELECT count(comments.status) as status FROM comments INNER JOIN posts
                                              on comments.post_id=posts.id where posts.user_id=? and posts.deleted_at
                                              is NULL AND comments.deleted_at is null
                                              and comments.status=0;', [Auth::user()->id]);

                return $view->with('newCommentsCount', $comments[0]->status);
            }
        });
        view()->composer('admin.layouts', function ($view) {
            $view->with('admin', Auth::user());
        });
    }
}
