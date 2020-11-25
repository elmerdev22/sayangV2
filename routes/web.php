<?php
/* 
    NOTE: AS MUCH AS POSSIBLE, CAN WE ALWAYS DO THIS PATTERN  

    1.) Route Pattern   : <folder name, if nested folder separate it with dot(.)>.<followed by controller>.<followed by method>
                Example : front-end.partner.my-products.index 
    3.) Blade Template  : (pattern and example is same in #1)
    4.) Livewire Blade  : Example {parent-namespace.follow-namespace.method.section_name}
        Livewire Blade alomost same with #1 but the method is folder and the actual component is the name of section
*/

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
    })->name('admin.login');
});

// IF AUTH
Route::group(['middleware' => ['auth']], function(){
    Route::get('/logout/{redirect}', 'Auth\LogoutController@index')->name('auth.logout');
});

Route::group(['as' => 'front-end.', 'namespace' => 'FrontEnd'], function(){
    
    Route::group(['as' => 'home.'], function (){

        $c = 'HomeController';
        Route::get('/', [
            'as' 	=> 'index',
            'uses'  => $c.'@index'
        ]);

        Route::get('/all-most-popular', [
            'as' 	=> 'all-most-popular',
            'uses'  => $c.'@all_most_popular'
        ]);
        
        Route::get('/all-recently-added', [
            'as' 	=> 'all-recently-added',
            'uses'  => $c.'@all_recently_added'
        ]);
        
        Route::get('/all-ending-soon', [
            'as' 	=> 'all-ending-soon',
            'uses'  => $c.'@all_ending_soon'
        ]);
        
    });  

    Route::group(['as' => 'help-centre.'], function (){

        $c = 'HelpCentreController';
        Route::get('/help-centre', [
            'as' 	=> 'index',
            'uses'  => $c.'@index'
        ]);
        
    });

    Route::group(['as' => 'about-us.'], function (){

        $c = 'AboutUsController';
        Route::get('/about-us', [
            'as' 	=> 'index',
            'uses'  => $c.'@index'
        ]);
        
    });

    Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function (){
        Route::group(['as' => 'information.'], function (){
            $c = 'InformationController';
            
            Route::get('/{slug}/{key_token}', [
                'as' 	=> 'index',
                'uses'  => $c.'@index'
            ]);

            Route::get('/redirect/{slug}/{key_token}/{type}', [
                'as' 	=> 'redirect',
                'uses'  => $c.'@redirect'
            ]);

            Route::get('/login-redirect/{slug}/{key_token}/{type}', [
                'as' 	=> 'login-redirect',
                'uses'  => $c.'@login_redirect'
            ]);
        });

        Route::group(['as' => 'list.'], function (){
            $c = 'ListingController';
            
            Route::get('/list', [
                'as' 	=> 'index',
                'uses'  => $c.'@index'
            ]);
        });

    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Profile'], function (){
        Route::group(['as' => 'partner.'], function (){
            $c = 'PartnerController';
            
            Route::get('/{slug}', [
                'as' 	=> 'index',
                'uses'  => $c.'@index'
            ]);

        });

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

        // Setting
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function (){
            $c = 'SettingController';
            
            Route::get('/bid', [
                'as'    => 'bid',
                'uses'  => $c.'@bid'
            ]);

            Route::get('/header-and-footer', [
                'as'    => 'header-and-footer',
                'uses'  => $c.'@header_and_footer'
            ]);

            Route::get('/notifications', [
                'as'    => 'notifications',
                'uses'  => $c.'@notifications'
            ]);

            Route::get('/help-centre', [
                'as'    => 'help-centre',
                'uses'  => $c.'@help_centre'
            ]);

            Route::get('/about', [
                'as'    => 'about',
                'uses'  => $c.'@about'
            ]);

            Route::get('/ratings', [
                'as'    => 'ratings',
                'uses'  => $c.'@ratings'
            ]);
            
        });

        // Orders and Receipt
        Route::group(['prefix' => 'order-and-receipt', 'as' => 'order-and-receipt.'], function (){
            $c = 'OrderAndReceiptController';
            
            Route::get('/', [
                'as'    => 'index',
                'uses'  => $c.'@index'
            ]);

            Route::get('/track/{order_no}', [
                'as'    => 'track',
                'uses'  => $c.'@track'
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
            
            Route::get('/change-password', [
		        'as' 	=> 'change-password',
		        'uses'  => $c.'@change_password'
		    ]);
        });

        // My Purchase
        Route::group(['prefix' => 'my-purchase', 'as' => 'my-purchase.'], function (){
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

        });
        // My Purchase
        Route::group(['prefix' => 'my-bids', 'as' => 'my-bids.'], function (){
			$c = 'MyBidController';
            
            // Purchase
			Route::get('/active', [
		        'as' 	=> 'active',
		        'uses'  => $c.'@active'
            ]);
			Route::get('/win', [
		        'as' 	=> 'win',
		        'uses'  => $c.'@win'
            ]);

            // Completed
			Route::get('/lose', [
		        'as' 	=> 'lose',
		        'uses'  => $c.'@lose'
            ]);

        });

        //My Cart
        Route::group(['prefix' => 'my-cart', 'as' => 'my-cart.'], function (){
			$c = 'MyCartController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);
            
        });

        //Check out
        Route::group(['prefix' => 'check-out', 'as' => 'check-out.'], function (){
			$c = 'CheckOutController';
			
			Route::get('/', [
		        'as' 	=> 'index',
		        'uses'  => $c.'@index'
            ]);

            Route::get('/pay', [
		        'as' 	=> 'pay',
		        'uses'  => $c.'@pay'
            ]);

            Route::get('/paymongo-pay', [
		        'as' 	=> 'paymongo-pay',
		        'uses'  => $c.'@paymongo_pay'
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

        // My product List
        Route::group(['prefix' => 'my-products', 'as' => 'my-products.'], function (){
            Route::group(['prefix' => 'list', 'as' => 'list.'], function (){
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
                
            });

            // My activities List
            Route::group(['prefix' => 'activities', 'as' => 'activities.'], function (){
                $c = 'MyProductsController';
                
                // My Activities
                Route::get('/', [
                    'as' 	=> 'index',
                    'uses'  => $c.'@activities'
                ]);

                Route::get('/active/{slug}/{key_token}', [
                    'as' 	=> 'active',
                    'uses'  => $c.'@active'
                ]);

                Route::get('/past/{slug}/{key_token}', [
                    'as' 	=> 'past',
                    'uses'  => $c.'@past'
                ]);

                Route::get('/cancelled/{slug}/{key_token}', [
                    'as' 	=> 'cancelled',
                    'uses'  => $c.'@cancelled'
                ]);
                
            });
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

// PRINT PREVIEW GROUP
Route::group(['prefix' => 'print-preview', 'as' => 'front-end.print-preview.', 'namespace' => 'FrontEnd\PrintPreview'], function(){
    
    Route::group(['prefix' => 'invoice', 'as' => 'invoice.', 'middleware' => ['auth']], function (){
        $c = 'InvoiceController';
        Route::get('/{invoice_no}', [
            'as' 	=> 'index',
            'uses'  => $c.'@index'
        ]);
    });

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