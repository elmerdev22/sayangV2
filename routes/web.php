<?php
Route::get('/', function () {
    return view('front-end.home.index');
});

// Partner/Merchant
Route::get('/partner/dashboard/template', function () {
    return view('front-end.partner.layouts.template');
});

// Merchant profile view
Route::get('/profile/partner-name', function () {
    return view('front-end.profile.partner');
});


// Redirect If Authenticated
Route::group(['middleware' => ['guest']], function(){
    Route::get('/register/partner', function () {
        return view('auth.register-partner');
    })->name('partner.register');
    Route::get('/login/partner', function () {
        return view('auth.login-partner');
    })->name('partner.login');
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

// ADMIN LOGIN
Route::group(['middleware' => ['guest']], function(){
    Route::get('admin/login', function () {
        return view('auth.login-admin');
    });
});

// ADMIN GROUP
Route::group(['middleware' => ['auth', 'auth.admin']], function(){
    Route::group(['prefix' => 'admin', 'as' => 'back-end.', 'namespace' => 'BackEnd'], function () {
        
        // Dashboard
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function (){
            $c = 'DashboardController';
            
            Route::get('/', [
                'as'    => 'index',
                'uses'  => $c.'@index'
            ]);
            
        });

        // Catalog
        Route::group(['prefix' => 'catalog', 'as' => 'catalog.'], function (){
            $c = 'CatalogController';
            
            Route::get('/', [
                'as'    => 'index',
                'uses'  => $c.'@index'
            ]);
            Route::get('/{key_token}', [
                'as'    => 'edit',
                'uses'  => $c.'@edit'
            ]);
            
        });

        // Partner
        Route::group(['prefix' => 'partner', 'as' => 'partner.'], function (){
            $c = 'PartnerController';
            
            Route::get('/', [
                'as'    => 'index',
                'uses'  => $c.'@index'
            ]);

            Route::get('/profile/{key_token}', [
                'as'    => 'profile',
                'uses'  => $c.'@profile'
            ]);
            
        });

        // User
        Route::group(['prefix' => 'user', 'as' => 'user.'], function (){
            $c = 'UserController';
            
            Route::get('/', [
                'as'    => 'index',
                'uses'  => $c.'@index'
            ]);

            Route::get('/profile/{key_token}', [
                'as'    => 'profile',
                'uses'  => $c.'@profile'
            ]);
            
        });

    });
});

// USER or BUYER GROUP
Route::group(['middleware' => ['auth', 'verification.check', 'auth.user']], function(){
    Route::group(['prefix' => 'user', 'as' => 'front-end.user.', 'namespace' => 'FrontEnd\User'], function () {
        
        // My Account
        Route::group(['prefix' => 'account', 'as' => 'my-account.'], function (){
			$c = 'MyAccountController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);
            
            Route::get('/addresses', [
		        'as' 	=> 'addresses',
		        'uses'  => $c.'@addresses'
            ]);
            
            Route::get('/banks-and-cards', [
		        'as' 	=> 'banks-and-cards',
		        'uses'  => $c.'@banks_and_cards'
		    ]);
        });

        // My Purchase
        Route::group(['prefix' => 'purchase', 'as' => 'my-purchase.'], function (){
			$c = 'MyPurchaseController';
            
            // Purchase
			Route::get('/list', [
		        'as' 	=> 'list',
		        'uses'  => $c.'@list'
            ]);
			Route::get('/list/{id}', [
		        'as' 	=> 'track',
		        'uses'  => $c.'@track'
            ]);

            // Completed
			Route::get('/completed', [
		        'as' 	=> 'completed',
		        'uses'  => $c.'@completed'
            ]);
			Route::get('/completed/{id}', [
		        'as' 	=> 'completed-details',
		        'uses'  => $c.'@completed_details'
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

        // Dashboard
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function (){
			$c = 'DashboardController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);
            
        });

        // My Menu List
        Route::group(['prefix' => 'my-products', 'as' => 'my-products.'], function (){
			$c = 'MyProductsController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);
            
            // Add Product in Menu
			Route::get('/add', [
		        'as' 	=> 'add',
		        'uses'  => $c.'@add'
            ]);
            
            // Edit Product in Menu
            Route::get('/edit/{slug}', [
                'as' 	=> 'edit',
                'uses'  => $c.'@edit'
            ]);
            
            // Edit Product in Menu
			Route::get('/start-sale', [
		        'as' 	=> 'start-sale',
		        'uses'  => $c.'@start_sale'
            ]);

            // My Activities
            Route::get('/activities', [
		        'as' 	=> 'activities',
		        'uses'  => $c.'@activities'
            ]);

            Route::get('/activities/{slug}/{key_token}', [
		        'as' 	=> 'activities-details',
		        'uses'  => $c.'@activities_details'
            ]);
            
        });

        // My Account
        Route::group(['prefix' => 'my-account', 'as' => 'my-account.'], function (){
			$c = 'MyAccountController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);

            Route::get('/bank-and-cards', [
		        'as' 	=> 'bank-and-cards',
		        'uses'  => $c.'@bank_and_cards'
            ]);
            
        });

        // QR Code
        Route::group(['prefix' => 'qr-code', 'as' => 'qr-code.'], function (){
			$c = 'QrCodeController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);

            
        });

        // Orders & Receipts
        Route::group(['prefix' => 'order-and-receipt', 'as' => 'order-and-receipt.'], function (){
			$c = 'OrderAndReceiptController';
			
			Route::get('/list', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);

			Route::get('/list/{id}', [
		        'as' 	=> 'track',
		        'uses'  => $c.'@track'
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
Route::get('/checkout', 'FrontEnd\product\CheckoutController@index')->name('account.checkout');