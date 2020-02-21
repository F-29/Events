<?php

use Illuminate\Http\Request;

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

Route::group([], function () {
    Route::get('/user', 'AuthController@user')->middleware('auth:api')->name('current-user');
    Route::post('/login', 'AuthController@login')->name('login-user');
    Route::post('/logout', 'AuthController@logout')->middleware('auth:api')->name('logout-user');
});

Route::group(['prefix' => '/users'], function () {
    $ctrl = 'UserController@';
    Route::get('/', $ctrl . 'index')->middleware('auth:api')->name('get-users');
    Route::get('/{id}', $ctrl . 'get_by_id')->middleware('auth:api')->name('get-user-by-id');
    Route::post('/', $ctrl . 'create')->name('create-user');
    Route::put('/{id}', $ctrl . 'update')->middleware('auth:api')->name('update-user');
    Route::delete('/{id}', $ctrl . 'delete')->middleware('auth:api')->name('delete-user');
});

Route::group(['prefix' => '/articles', 'middleware' => 'auth:api'], function () {
    $ctrl = 'ArticleController@';
    Route::get('/', $ctrl . 'index')->name('get-articles');
    Route::get('/{id}', $ctrl . 'get_by_id')->name('get-article-by-id');
    Route::post('/', $ctrl . 'create')->name('create-article');
    Route::put('/{id}', $ctrl . 'update')->name('update-article');
    Route::delete('/{id}', $ctrl . 'delete')->name('delete-article');
});
