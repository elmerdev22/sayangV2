<aside class="main-sidebar sidebar-sayang-primary elevation-2">
    <!-- Brand Logo -->
    <a href="/" class="brand-link logo-switch text-center" target="_blank">
        <img src="{{ asset('images/logo/icon.png') }}" alt="Sayang Admin Logo Small" class="brand-image-xl logo-xs">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Sayang Admin Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a>
    <!-- Sidebar -->
    <div class="sidebar sayang-sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel sayang-user-panel mt-1 pb-1 pt-1 mb-3 d-flex">
            @php
                $account = Utility::auth_user_account();
                if($account->photo){
                    $photo_url = asset('images/default-photo/account.png');
                }else if($account->photo_provider_link){
                    $photo_url = $account->photo_provider_link;
                }else{
                    $photo_url = asset('images/default-photo/account.png');
                }
            @endphp
            <div class="image" title="Profile">
                <a href="{{route('front-end.partner.my-account.index')}}">
                    <img src="{{$photo_url}}" class="img-circle elevation-1" alt="User Image">
                </a>
            </div>
            <div class="info block-element w-100" title="Profile">
                <a href="{{route('front-end.partner.my-account.index')}}" class="d-block">{{ucwords($account->first_name.' '.$account->last_name)}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills sayang-nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('front-end.partner.dashboard.index')}}" class="nav-link {{Route::is('front-end.partner.dashboard.index') ? 'sayang-nav-link-active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{Route::is('front-end.partner.my-account.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.my-account.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Account <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-account.index')}}" class="nav-link {{Route::is('front-end.partner.my-account.index') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-icon fas"></i>
                                <p>Banks & Cards</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-icon fas"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>My Items</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Orders & Receipt</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('front-end.partner.qr-code.index')}}" class="nav-link {{\Route::is('front-end.partner.qr-code.index') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-qrcode"></i>
                        <p>Scan QR Code</p>
                    </a>
                </li>
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
</aside>