<?php

Route::get('/', function () {
    return view('front-end.home.index');
});

Route::get('/register/merchant', function () {
    return view('auth.register-merchant');
});

Route::get('/register/merchant/verify', function () {
    return view('auth.verify');
});

// Merchant Account
Route::get('/account/complete-details', function () {
    return view('front-end.account.merchant.index');
});

// User or Buyer
Route::group(['middleware' => ['auth', 'auth.user']], function(){
    Route::group(['prefix' => 'user', 'as' => 'front-end.user.', 'namespace' => 'FrontEnd\User'], function () {
        
        Route::group(['prefix' => 'my-account', 'as' => 'my-account.'], function (){
			$c = 'MyAccountController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
		    ]);
		});
    });
});




Route::get('/products', function () {
    return view('front-end.product.all');
});

// Login Redirect
Route::get('/login-redirect', 'Auth\LoginRedirectController@index')->name('login.redirect');

Route::get('/product/{slug}', 'FrontEnd\product\SelectedController@index')->name('selected.product');
Route::get('/my-cart', 'FrontEnd\product\CartController@index')->name('account.cart');
// Auth API login google,fb
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
