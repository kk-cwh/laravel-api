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
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

Route::get('/user', function () {
	return new UserCollection(User::all());
});
Route::get('/users', function () {
	// return (new UserResource(User::find(1)))->additional(['meta' => [
	// 	'key2' => 'va2lue',
	// ]]);
	return  UserResource::collection(User::get())->additional(['meta' => [
		'key2' => 'va2lue',
	]]);
});

// Route::get('/u','Api\ApiController@index');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/uu','Api\UserController@index');