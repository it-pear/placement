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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts/getall', 'App\Http\Controllers\Posts\PostsController@getAll');
Route::get('posts/{id}', 'App\Http\Controllers\Posts\PostsController@getById');
Route::post('posts/save', 'App\Http\Controllers\Posts\PostsController@savePost');

// Route::group([
//     'prefix' => 'auth'
// ], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('registration', 'App\Http\Controllers\AuthController@registration');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
// });