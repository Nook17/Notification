<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@add_message')->name('add_message');
Route::delete('/{user}', 'HomeController@home_del_follow')->name('home_del_follow');

// Route::resource('/user', 'UserController');

Route::post('/search', 'UserController@search')->name('search');
Route::post('/follow/{user}', 'UserController@add_follow')->name('add_follow');
Route::delete('/follow/{user_id}/{user_name}', 'UserController@del_follow')->name('del_follow');
