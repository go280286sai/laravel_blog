<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubsController;
use App\Http\Controllers\TelegramController;
use App\Http\Middleware\AuthAdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UsersOnlineMiddleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/post/{slug}', 'show')->name('post.show');
    Route::get('/tag/{slug}', 'tag')->name('tag.show');
    Route::get('/', 'index')->name('/');
    Route::get('/category/{slug}', 'category')->name('category.show');
});

Route::controller(SubsController::class)->group(function () {
    Route::post('/subscribe', 'subscribe');
    Route::get('/verify/{token}', 'verify');
    Route::get('/unsubscribe/{id}', 'unsetEmail');
    Route::post('/unsubscribe_email/', 'unsets');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('/category', 'index');
    Route::resource('/cat', CategoriesController::class);
    Route::get('/category', 'create');
});

Route::controller(SocialController::class)->group(function () {
    Route::get('/auth/facebook', 'facebookRedirect')->name('auth.facebook');
    Route::get('/auth/facebook/callback', 'loginWithFacebook');
    Route::get('/auth/github', 'githubRedirect')->name('auth.github');
    Route::get('/auth/github/callback', 'loginWithGithub');
});

Route::post('/search', [SearchController::class, 'index']);

Route::controller(MessageController::class)->group(function () {
    Route::get('/contact', 'show');
    Route::post('/contact', 'create');
});

Route::get('/greeting/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ru', 'uk'])) {
        abort(400);
    }
    Cache::put('lang', $locale, 1000);

    return back();
});

Route::view('/about', 'pages/about')->name('about');

Route::view('/test', 'pages.chat');

Route::group(['prefix' => 'admin', 'middleware' => [AuthAdminMiddleware::class, UsersOnlineMiddleware::class]],
    function () {
        Route::resource('/tags', TagsController::class);

        Route::resource('/categories', CategoriesController::class);

        Route::resource('/users', UsersController::class);

        Route::controller(UsersController::class)->group(function () {
            Route::post('/user_comment', 'viewCommentUser');
            Route::post('/add_comment_user', 'addCommentUser');
            Route::post('/viewMailUser', 'viewMailUser');
            Route::post('/sendMailUser', 'sendMailUser');
            Route::get('/toggle/{id}', 'toggle');
            Route::get('/users_trash', 'trash')->name('users_trash');
            Route::post('/users_recover', 'recover');
            Route::get('/chat_user/{id}', 'chatUser');
        });

        Route::controller(PostsController::class)->group(function () {
            Route::post('/post_comment', 'viewCommentPost');
            Route::post('/add_comment', 'addCommentPost');
            Route::post('/viewMail', 'viewMailPost');
            Route::post('/sendMail', 'sendMailPost');
            Route::get('/posts_trash', 'trash')->name('posts_trash');
            Route::post('/posts_recover', 'recover');
        });

        Route::controller(AdminMessageController::class)->group(function () {
            Route::resource('/messages', AdminMessageController::class);
            Route::post('/message_getAnswer', 'getAnswer');
            Route::post('/message_setAnswer', 'setAnswer');
            Route::get('/message_mailing_list', 'mailing_list');
            Route::post('/message_sendMailing', 'sendMailing');
            Route::get('/message_delete_all', 'deleteShows');
        });

        Route::controller(TelegramController::class)->group(function () {
            Route::get('/telegram', 'index')->name('telegram');
            Route::get('/telegram_write', 'create');
            Route::post('/telegram_send', 'store');
            Route::get('/telegram_remove/{id}', 'remove');
            Route::get('/telegram_update', 'update');
            Route::post('/telegram_answer', 'answer');
            Route::post('/telegram_sendAnswer', 'sendAnswer');
        });

        Route::controller(SubscribersController::class)->group(function () {
            Route::get('/subscribers_trash', 'trash')->name('subscribers_trash');
            Route::post('/subscribers_recover', 'recover');
            Route::resource('/subscribers', SubscribersController::class);
        });

        Route::controller(CommentsController::class)->group(function () {
            Route::get('/comments_trash', 'trash')->name('comments_trash');
            Route::post('/comments_recover', 'recover');
        });

        Route::view('/view_mailing_sub', 'emails.mailing_list_sub', ['title' => 'Constructor', 'content' => 'Some text', 'id' => 'test']);

        Route::view('/view_mailing', 'emails.mailing_list', ['title' => 'Constructor', 'content' => 'Some text']);

        Route::post('/chat_user_send', [ChatController::class, 'sendUser']);
    });

Route::group(['prefix' => 'admin', 'middleware' => [AuthMiddleware::class, UsersOnlineMiddleware::class]],
    function () {
        Route::resource('/posts', PostsController::class);

        Route::controller(CommentsController::class)->group(function () {
            Route::get('/comments', 'index');
            Route::get('/comments/toggle/{id}', 'toggle');
            Route::delete('/comments/{id}/destroy', 'destroy')->name('comments.destroy');
            Route::post('/comment', 'store');
        });

        Route::get('/posts/toggle/{id}', [PostsController::class, 'toggle']);

        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'index');
            Route::post('/profile', 'store');
        });

        Route::post('/search', [SearchController::class, 'show']);

        Route::controller(ChatController::class)->group(function () {
            Route::get('chat', 'index');
            Route::post('chat_send', 'send');
        });
    });

require __DIR__ . '/auth.php';
