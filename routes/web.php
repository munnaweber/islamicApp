<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/panel', 'AdminController@adminpanel')->name('adminpanel');
Route::get('admin/check/all/category', 'AdminController@checkcategory');

Route::get('admin/all/contents', 'AdminController@allcontent');
Route::get('admin/create/contents', 'AdminController@contentadd');
Route::get('admin/content/edit/{id}', 'AdminController@contentedit');
Route::get('admin/content/details/{id}', 'AdminController@contentdetails');
Route::get('admin/content/delete/{id}', 'AdminController@contentdelete');
Route::post('admin/panel/create/content/post', 'AdminController@createcontent');
Route::post('admin/panel/update/content/post', 'AdminController@updatecontent');


