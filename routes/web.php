<?php

Route::get('/', function () {
    return view('front-end.home.index');
});
Route::get('/product/{slug}', 'FrontEnd\product\SelectedController@index')->name('selected.product');
// Auth API login google,fb
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
