<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', '\App\Http\Controllers\Api\AuthController@loginUser');
Route::post('/register', '\App\Http\Controllers\Api\AuthController@createUser');
Route:: middleware('auth:sanctum')->group(function () {
    Route::get('/me', '\App\Http\Controllers\Api\AuthController@me');
    Route::apiResource('/profile', '\App\Http\Controllers\Api\ProfileController');
    Route::apiResource('/post', '\App\Http\Controllers\Api\PostsController');
});
Route::get('/category', '\App\Http\Controllers\Api\CategoriesController@index');
Route::get('/tags', '\App\Http\Controllers\Api\TagsController@index');
