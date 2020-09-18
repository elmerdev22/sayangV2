<?php
Route::get('/', function () {
    return view('front-end.home.index');
});


// Merchant Account
Route::get('/account/complete-details', function () {
    return view('front-end.account.merchant.index');
});

// Redirect If Authenticated
Route::group(['middleware' => ['guest']], function(){
    Route::get('/register/merchant', function () {
        return view('auth.register-merchant');
    });
    
    Route::get('/register/merchant/verify', function () {
        return view('auth.verify');
    });
});

// USER or BUYER GROUP
Route::group(['middleware' => ['auth', 'verification.check', 'auth.user']], function(){
    Route::group(['prefix' => 'user', 'as' => 'front-end.user.', 'namespace' => 'FrontEnd\User'], function () {
        
        // My Account
        Route::group(['prefix' => 'my-account', 'as' => 'my-account.'], function (){
			$c = 'MyAccountController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
		    ]);
        });

        // Verification Check
        Route::group(['prefix' => 'verification-check', 'as' => 'verification-check.'], function (){
			$c = 'VerificationCheckController';
			
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
Route::group(['prefix' => 'login-redirect', 'as' => 'login-redirect.', 'namespace' => 'Auth'], function () {
    $c = 'LoginRedirectController';
    
    Route::get('/', [
        'as' 	=> 'index',
        'uses'  => $c.'@index'
    ]);

    Route::get('socialite/{provider}/{type}', [
        'as' 	=> 'socialite',
        'uses'  => $c.'@socialite'
    ]);
});

// Auth API Login using Google or Facebook
Route::group(['prefix' => 'login', 'as' => 'login.', 'namespace' => 'Auth'], function () {
    $c = 'LoginController';
    
    Route::get('/{provider}', [
        'as' 	=> 'redirectToProvider',
        'uses'  => $c.'@redirectToProvider'
    ]);
    Route::get('/{provider}/callback', [
        'as' 	=> 'handleProviderCallback',
        'uses'  => $c.'@handleProviderCallback'
    ]);
});
Auth::routes();

Route::get('/product/{slug}', 'FrontEnd\product\SelectedController@index')->name('selected.product');
Route::get('/my-cart', 'FrontEnd\product\CartController@index')->name('account.cart');