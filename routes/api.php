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

Route::post('auth/login', 'Api\JwtAuthController@login')->name('auth.login');

Route::namespace('Api')->group(function (){

	Route::get('auth/me', 'JwtAuthController@me')->name('auth.me');
	Route::delete('auth/logout', 'JwtAuthController@logout')->name('auth.logout');
	Route::patch('auth/refresh', 'JwtAuthController@refresh')->name('auth.refresh');

    Route::resource('permissions', 'PermissionController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('roles', 'RoleController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('users', 'UserController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('menus', 'MenuController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('categories', 'CategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('tags', 'TagController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('links', 'LinkController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('articles', 'ArticleController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);


});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




