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
Route::get('posts/getall/recommend', 'App\Http\Controllers\PostsController@getDataForRecommend');
Route::get('posts/{id}', 'App\Http\Controllers\PostsController@getById');
Route::get('posts/getparams/get', 'App\Http\Controllers\PostsController@getAllFilter');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('posts/save', 'App\Http\Controllers\PostsController@savePost');
    Route::post('posts/edit/{id}', 'App\Http\Controllers\PostsController@editPost');
    Route::post('posts/del/{id}', 'App\Http\Controllers\PostsController@delPost');
});

// услуги
Route::get('services/getall', 'App\Http\Controllers\ServicesController@getAll');
Route::get('services/getall/recommend', 'App\Http\Controllers\ServicesController@getDataForRecommend');
Route::get('services/{id}', 'App\Http\Controllers\ServicesController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('services/save', 'App\Http\Controllers\ServicesController@saveService');
    Route::post('services/edit/{id}', 'App\Http\Controllers\ServicesController@editService');
    Route::post('services/del/{id}', 'App\Http\Controllers\ServicesController@delService');
});

// категории
Route::get('categories/getall', 'App\Http\Controllers\CategoriesController@getAll');
Route::get('categories/{id}', 'App\Http\Controllers\CategoriesController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('categories/save', 'App\Http\Controllers\CategoriesController@saveCategory');
    Route::post('categories/edit/{id}', 'App\Http\Controllers\CategoriesController@editCategory');
    Route::post('categories/del/{id}', 'App\Http\Controllers\CategoriesController@delCategory');
});

// тип квартиры
Route::get('type/getall', 'App\Http\Controllers\TypeController@getAll');
Route::get('type/{id}', 'App\Http\Controllers\TypeController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('type/save', 'App\Http\Controllers\TypeController@saveType');
    Route::post('type/edit/{id}', 'App\Http\Controllers\TypeController@updateType');
    Route::post('type/del/{id}', 'App\Http\Controllers\TypeController@delType');
});

// инфракструктура
Route::get('property/getall', 'App\Http\Controllers\PropertiesController@getAll');
Route::get('property/{id}', 'App\Http\Controllers\PropertiesController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('property/save', 'App\Http\Controllers\PropertiesController@saveProperty');
    Route::post('property/edit/{id}', 'App\Http\Controllers\PropertiesController@updateProperty');
    Route::post('property/del/{id}', 'App\Http\Controllers\PropertiesController@delProperty');
});

// преимущества
Route::get('advantages/getall', 'App\Http\Controllers\AdvantagesController@getAll');
Route::get('advantages/{id}', 'App\Http\Controllers\AdvantagesController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('advantages/save', 'App\Http\Controllers\AdvantagesController@saveAdvantage');
    Route::post('advantages/edit/{id}', 'App\Http\Controllers\AdvantagesController@updateAdvantage');
    Route::post('advantages/del/{id}', 'App\Http\Controllers\AdvantagesController@delAdvantage');
});

// города
Route::get('city/getall', 'App\Http\Controllers\CityController@getAll');
Route::get('city/{id}', 'App\Http\Controllers\CityController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('city/save', 'App\Http\Controllers\CityController@saveCity');
    Route::post('city/edit/{id}', 'App\Http\Controllers\CityController@updateCity');
    Route::post('city/del/{id}', 'App\Http\Controllers\CityController@delCity');
});

// регионы
Route::get('region/getall', 'App\Http\Controllers\RegionController@getAll');
Route::get('region/{id}', 'App\Http\Controllers\RegionController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('region/save', 'App\Http\Controllers\RegionController@saveRegion');
    Route::post('region/edit/{id}', 'App\Http\Controllers\RegionController@updateRegion');
    Route::post('region/del/{id}', 'App\Http\Controllers\RegionController@delRegion');
});

// Дистанции до моря
Route::get('distance/getall', 'App\Http\Controllers\DistanceController@getAll');
Route::get('distance/{id}', 'App\Http\Controllers\DistanceController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('distance/save', 'App\Http\Controllers\DistanceController@saveDistance');
    Route::post('distance/edit/{id}', 'App\Http\Controllers\DistanceController@updateDistance');
    Route::post('distance/del/{id}', 'App\Http\Controllers\DistanceController@delDistance');
});

// планировка
Route::get('layout/getall', 'App\Http\Controllers\LayoutController@getAll');
Route::get('layout/{id}', 'App\Http\Controllers\LayoutController@getById');
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('layout/save', 'App\Http\Controllers\LayoutController@saveLayout');
    Route::post('layout/edit/{id}', 'App\Http\Controllers\LayoutController@updateLayout');
    Route::post('layout/del/{id}', 'App\Http\Controllers\LayoutController@delLayout');
});

// Страницы
Route::get('pages/post/single', 'App\Http\Controllers\pages\CatalogIdController@getData');

// пользователи
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::get('users/getall', 'App\Http\Controllers\UserController@getAll');
    Route::get('users/{id}', 'App\Http\Controllers\UserController@getById');
    Route::post('users/edit/{id}', 'App\Http\Controllers\UserController@editUser');
    Route::post('users/del/{id}', 'App\Http\Controllers\UserController@delUser');
});

// картинки
Route::middleware('auth:api', 'check.user.role')->group(function () {
    Route::post('images/del/{id}', 'App\Http\Controllers\ImageController@deleteImageById');
});

// авторизация
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('registration', 'App\Http\Controllers\AuthController@registration');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
Route::post('me', 'App\Http\Controllers\AuthController@me');
