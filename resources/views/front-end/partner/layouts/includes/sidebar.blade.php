<aside class="main-sidebar sidebar-sayang-primary elevation-2">
    <!-- Brand Logo -->
    <a href="/" class="brand-link logo-switch text-center" target="_blank">
        <img src="{{ asset('images/logo/icon.png') }}" alt="Sayang Admin Logo Small" class="brand-image-xl logo-xs">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Sayang Admin Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a>
    <!-- Sidebar -->
    <div class="sidebar sayang-sidebar">
        <!-- Sidebar user panel (optional) -->
        @livewire('front-end.partner.sidebar.profile')

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
                            <a href="{{route('front-end.partner.my-account.bank-and-cards')}}" class="nav-link {{Route::is('front-end.partner.my-account.bank-and-cards') ? 'sayang-nav-link-active':''}}">
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
                
                <li class="nav-item has-treeview {{Route::is('front-end.partner.my-products.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.my-products.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>My Products <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-products.index')}}" class="nav-link {{Route::is('front-end.partner.my-products.*') && !Route::is('front-end.partner.my-products.activities') && !Route::is('front-end.partner.my-products.activities-details') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-products.activities')}}" class="nav-link {{Route::is('front-end.partner.my-products.activities') || Route::is('front-end.partner.my-products.activities-details') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Activities</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{Route::is('front-end.partner.order-and-receipt.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.order-and-receipt.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Orders & Receipt <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.index')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.*') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifications</p>
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