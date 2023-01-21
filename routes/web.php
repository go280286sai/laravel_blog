<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', '\App\Http\Controllers\HomeController@index')->name('/');
Route::get('/post/{slug}', '\App\Http\Controllers\HomeController@show')->name('post.show');
Route::get('/tag/{slug}', '\App\Http\Controllers\HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', '\App\Http\Controllers\HomeController@category')->name('category.show');
Route::post('/subscribe', '\App\Http\Controllers\SubsController@subscribe');
Route::get('/verify/{token}', '\App\Http\Controllers\SubsController@verify');
Route::get('/category', '\App\Http\Controllers\Admin\CategoriesController@index');
Route::resource('/cat', '\App\Http\Controllers\Admin\CategoriesController');
Route::get('/category', '\App\Http\Controllers\Admin\CategoriesController@create');
Route::get('/auth/facebook', '\App\Http\Controllers\SocialController@facebookRedirect')->name('auth.facebook');
Route::get('/auth/facebook/callback', '\App\Http\Controllers\SocialController@loginWithFacebook');
Route::get('/auth/github', '\App\Http\Controllers\SocialController@githubRedirect')->name('auth.github');
Route::get('/auth/github/callback', '\App\Http\Controllers\SocialController@loginWithGithub');
Route::post('/search', '\App\Http\Controllers\SearchController@index');
Route::get('/contact', '\App\Http\Controllers\MessageController@show');
Route::post('/contact', '\App\Http\Controllers\MessageController@create');
Route::get('/greeting/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ru', 'uk'])) {
        abort(400);
    }
    Cache::put('lang', $locale, 1000);

    return back();
});
Route::view('/about', 'pages/about')->name('about');
Route::get('/unsubscribe/{id}', '\App\Http\Controllers\SubsController@unsetEmail');
Route::post('/unsubscribe_email/', '\App\Http\Controllers\SubsController@unsets');
Route::get('/test', '\App\Http\Controllers\TestController@index');
Route::group(['prefix' => 'admin', 'middleware' => ['\App\Http\Middleware\AuthAdminMiddleware', '\App\Http\Middleware\UsersOnlineMiddleware']], function () {
    Route::resource('/tags', '\App\Http\Controllers\Admin\TagsController');
    Route::resource('/categories', '\App\Http\Controllers\Admin\CategoriesController');
    Route::resource('/subscribers', '\App\Http\Controllers\Admin\SubscribersController');
    Route::resource('/users', '\App\Http\Controllers\Admin\UsersController');
    Route::post('/user_comment', '\App\Http\Controllers\Admin\UsersController@viewCommentUser');
    Route::post('/add_comment_user', '\App\Http\Controllers\Admin\UsersController@addCommentUser');
    Route::post('/viewMailUser', '\App\Http\Controllers\Admin\UsersController@viewMailUser');
    Route::post('/sendMailUser', '\App\Http\Controllers\Admin\UsersController@sendMailUser');
    Route::post('/post_comment', '\App\Http\Controllers\Admin\PostsController@viewCommentPost');
    Route::post('/add_comment', '\App\Http\Controllers\Admin\PostsController@addCommentPost');
    Route::post('/viewMail', '\App\Http\Controllers\Admin\PostsController@viewMailPost');
    Route::post('/sendMail', '\App\Http\Controllers\Admin\PostsController@sendMailPost');
    Route::get('/toggle/{id}', '\App\Http\Controllers\Admin\UsersController@toggle');
    Route::get('/subscribers_trash', '\App\Http\Controllers\Admin\SubscribersController@trash')->name('subscribers_trash');
    Route::post('/subscribers_recover', '\App\Http\Controllers\Admin\SubscribersController@recover');
    Route::get('/users_trash', '\App\Http\Controllers\Admin\UsersController@trash')->name('users_trash');
    Route::post('/users_recover', '\App\Http\Controllers\Admin\UsersController@recover');
    Route::get('/comments_trash', '\App\Http\Controllers\Admin\CommentsController@trash')->name('comments_trash');
    Route::post('/comments_recover', '\App\Http\Controllers\Admin\CommentsController@recover');
    Route::get('/posts_trash', '\App\Http\Controllers\Admin\PostsController@trash')->name('posts_trash');
    Route::post('/posts_recover', '\App\Http\Controllers\Admin\PostsController@recover');
    Route::resource('/messages', '\App\Http\Controllers\Admin\MessageController');
    Route::post('/message_getAnswer', '\App\Http\Controllers\Admin\MessageController@getAnswer');
    Route::post('/message_setAnswer', '\App\Http\Controllers\Admin\MessageController@setAnswer');
    Route::get('/message_mailing_list', '\App\Http\Controllers\Admin\MessageController@mailing_list');
    Route::post('/message_sendMailing', '\App\Http\Controllers\Admin\MessageController@sendMailing');
    Route::get('/message_delete_all', '\App\Http\Controllers\Admin\MessageController@deleteShows');
    Route::get('/telegram', '\App\Http\Controllers\TelegramController@index')->name('telegram');
    Route::get('/telegram_write', '\App\Http\Controllers\TelegramController@create');
    Route::post('/telegram_send', '\App\Http\Controllers\TelegramController@store');
    Route::get('/telegram_remove/{id}', '\App\Http\Controllers\TelegramController@remove');
    Route::get('/telegram_update', '\App\Http\Controllers\TelegramController@update');
    Route::post('/telegram_answer', '\App\Http\Controllers\TelegramController@answer');
    Route::post('/telegram_sendAnswer', '\App\Http\Controllers\TelegramController@sendAnswer');
    Route::view('/view_mailing_sub', 'emails.mailing_list_sub', ['title'=>'Constructor', 'content'=>'Some text', 'id'=>'test']);
    Route::view('/view_mailing', 'emails.mailing_list', ['title'=>'Constructor', 'content'=>'Some text']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['\App\Http\Middleware\AuthMiddleware', '\App\Http\Middleware\UsersOnlineMiddleware']], function () {
    Route::resource('/posts', '\App\Http\Controllers\Admin\PostsController');
    Route::get('/comments', '\App\Http\Controllers\Admin\CommentsController@index');
    Route::get('/comments/toggle/{id}', '\App\Http\Controllers\Admin\CommentsController@toggle');
    Route::get('/posts/toggle/{id}', '\App\Http\Controllers\Admin\PostsController@toggle');
    Route::delete('/comments/{id}/destroy', '\App\Http\Controllers\Admin\CommentsController@destroy')->name('comments.destroy');
    Route::get('/dashboard', '\App\Http\Controllers\Admin\DashboardController@index');
    Route::get('/profile', '\App\Http\Controllers\Admin\ProfileController@index');
    Route::post('/profile', '\App\Http\Controllers\Admin\ProfileController@store');
    Route::post('/comment', '\App\Http\Controllers\CommentsController@store');
    Route::post('/search', '\App\Http\Controllers\SearchController@show');
});
require __DIR__.'/auth.php';
