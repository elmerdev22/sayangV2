<?php
Route::get('/', function () {
    return view('front-end.home.index');
});


// Merchant Account
Route::get('/account/complete-details', function () {
    return view('front-end.account.merchant.index');
});

// Merchant profile view
Route::get('/profile/partner-name', function () {
    return view('front-end.profile.partner');
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

// Partner menu tab temporary public agent

// QR-code view
Route::get('/partner/qr-code', function () {
    return view('front-end.partner.my-account.qr-code');
});

// VERIFICATION CHECK
Route::group(['middleware' => ['auth', 'verification.check']], function(){
    Route::group(['prefix' => 'verification-check', 'as' => 'verification-check.', 'namespace' => 'Auth'], function () {
        $c = 'VerificationCheckController';
        
        Route::get('/', [
            'as' 	=> 'index',
            'uses'  => $c.'@index'
        ]);
    });
});
Route::group(['prefix' => 'admin'], function (){

    Route::get('/', function () {
        return view('admin.login');
    });
    
    Route::group(['prefix' => 'cms'], function (){
        $c = 'Admin\AdminController';
        
        Route::get('/', [
            'as' 	=> 'admin.index',
            'uses'  => $c.'@index'
        ]);

        Route::group(['prefix' => 'accounts'], function () use ($c){
        
            Route::get('/partner', [
                'as' 	=> 'admin.cms.partner',
                'uses'  => $c.'@partner',
                'name'  => 'Partner',
                'alter' => 'Merchant'
            ]);
            
            Route::get('/partner/profile/{key_token}', [
                'as' 	=> 'admin.cms.partner.profile',
                'uses'  => $c.'@profile',
                'name'  => 'Partner',
                'alter' => 'Merchant'
            ]);

            Route::get('/user', [
                'as' 	=> 'admin.cms.user',
                'uses'  => $c.'@user',
                'name'  => 'User',
                'alter' => 'Buyer'
            ]);

            Route::get('/user/profile/{key_token}', [
                'as' 	=> 'admin.cms.user.profile',
                'uses'  => $c.'@profile',
                'name'  => 'User',
                'alter' => 'Buyer'
            ]);

    
        });
    
        Route::group(['prefix' => 'products'], function () use ($c){
        
            Route::get('/catalog', [
                'as' 	=> 'admin.cms.catalog',
                'uses'  => $c.'@catalog',
                'name'  => 'Catalog'
            ]);
            
        });

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
    });
});

// MERCHANT OR PARTNER GROUP
Route::group(['middleware' => ['auth', 'verification.check', 'auth.partner']], function(){
    Route::group(['prefix' => 'partner', 'as' => 'front-end.partner.', 'namespace' => 'FrontEnd\Partner'], function () {
        
        // Account Activation
        Route::group(['prefix' => 'account-activation', 'as' => 'account-activation.'], function (){
			$c = 'AccountActivationController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
		    ]);
        });

        // My Account
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