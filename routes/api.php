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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('all/content/list', 'ApiController@allcontent');
Route::get('all/content/list/by/category/{id}', 'ApiController@allcontentbyid');
Route::get('all/content/list/to/single/{id}', 'ApiController@singleContent');
Route::get('check/saved/by/user/all/posts/{postid}/{userid}', 'ApiController@getsavedpostschecked');
Route::post('register/now', 'ApiController@registernow');
Route::post('login/now', 'ApiController@loginnow');
Route::post('check/saved', 'ApiController@checksavedPosts');
Route::post('check/saved/by/user', 'ApiController@checksavedPostsbyUser');