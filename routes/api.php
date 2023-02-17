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

// посты
Route::get('posts/getall', 'App\Http\Controllers\PostsController@getAll');
Route::get('posts/{id}', 'App\Http\Controllers\PostsController@getById');
Route::post('posts/save', 'App\Http\Controllers\PostsController@savePost');
Route::post('posts/edit/{id}', 'App\Http\Controllers\PostsController@editPost');
Route::post('posts/del/{id}', 'App\Http\Controllers\PostsController@delPost');

// категории
Route::get('categories/getall', 'App\Http\Controllers\CategoriesController@getAll');
Route::get('categories/{id}', 'App\Http\Controllers\CategoriesController@getById');
Route::post('categories/save', 'App\Http\Controllers\CategoriesController@saveCategory');
Route::post('categories/del/{id}', 'App\Http\Controllers\CategoriesController@delCategory');

// тип квартиры
Route::get('type/getall', 'App\Http\Controllers\TypeController@getAll');
Route::get('type/{id}', 'App\Http\Controllers\TypeController@getById');
Route::post('type/save', 'App\Http\Controllers\TypeController@saveType');
Route::post('type/del/{id}', 'App\Http\Controllers\TypeController@delType');

// инфракструктура
Route::get('property/getall', 'App\Http\Controllers\PropertiesController@getAll');
Route::get('property/{id}', 'App\Http\Controllers\PropertiesController@getById');
Route::post('property/save', 'App\Http\Controllers\PropertiesController@saveProperty');
Route::post('property/del/{id}', 'App\Http\Controllers\PropertiesController@delProperty');

// преимущества
Route::get('advantages/getall', 'App\Http\Controllers\AdvantagesController@getAll');
Route::get('advantages/{id}', 'App\Http\Controllers\AdvantagesController@getById');
Route::post('advantages/save', 'App\Http\Controllers\AdvantagesController@saveAdvantage');
Route::post('advantages/del/{id}', 'App\Http\Controllers\AdvantagesController@delAdvantage');

// города
Route::get('city/getall', 'App\Http\Controllers\CityController@getAll');
Route::get('city/{id}', 'App\Http\Controllers\CityController@getById');
Route::post('city/save', 'App\Http\Controllers\CityController@saveCity');
Route::post('city/del/{id}', 'App\Http\Controllers\CityController@delCity');

// регионы
Route::get('region/getall', 'App\Http\Controllers\RegionController@getAll');
Route::get('region/{id}', 'App\Http\Controllers\RegionController@getById');
Route::post('region/save', 'App\Http\Controllers\RegionController@saveRegion');
Route::post('region/del/{id}', 'App\Http\Controllers\RegionController@delRegion');

// Страницы
Route::get('pages/post/single', 'App\Http\Controllers\pages\CatalogIdController@getData');

// авторизация
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('registration', 'App\Http\Controllers\AuthController@registration');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
Route::post('me', 'App\Http\Controllers\AuthController@me');
