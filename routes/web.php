<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@add_message')->name('add_message');
Route::delete('/{user}', 'HomeController@home_del_follow')->name('home_del_follow');

Route::post('/search', 'UserController@search')->name('search');
Route::post('/follow/{user}', 'UserController@add_follow')->name('add_follow');
Route::delete('/follow/{user_id}/{user_name}', 'UserController@del_follow')->name('del_follow');

Route::get('/settings', 'UserController@settings_index')->name('settings_index');
Route::post('/settings', 'UserController@settings_add')->name('settings_add');
Route::get('markAsRead', 'UserController@markAsRead')->name('markAsRead');
