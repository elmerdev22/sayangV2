<aside class="main-sidebar sidebar-sayang-primary elevation-2">
    <!-- Brand Logo -->
    <a href="/" class="brand-link logo-switch text-center" target="_blank">
        <img src="{{ UploadUtility::content_photo('icon') }}" alt="Sayang Admin Logo Small" class="brand-image-xl logo-xs">
        <img src="{{ UploadUtility::content_photo('logo') }}" alt="Sayang Admin Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a>
    <!-- Sidebar -->
    <div class="sidebar sayang-sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel sayang-user-panel mt-1 pb-1 pt-1 mb-3 d-flex">
            @php
                $account   = Utility::auth_user_admin();
                $photo_url = asset('images/default-photo/admin.png');
            @endphp
            <div class="image" title="Profile">
                <a href="{{route('back-end.dashboard.index')}}">
                    <img src="{{$photo_url}}" class="img-circle elevation-1" alt="User Image">
                </a>
            </div>
            <div class="info block-element w-100">
                <a href="{{route('back-end.dashboard.index')}}" class="d-block">{{ucwords($account->first_name.' '.$account->last_name)}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills sayang-nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('back-end.dashboard.index')}}" class="nav-link {{Route::is('back-end.dashboard.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.partner.index')}}" class="nav-link {{Route::is('back-end.partner.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Partners</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.user.index')}}" class="nav-link {{Route::is('back-end.user.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.products.index')}}" class="nav-link {{Route::is('back-end.products.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.order-and-receipt.index')}}" class="nav-link {{Route::is('back-end.order-and-receipt.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Orders & Receipt</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.catalog.index')}}" class="nav-link {{Route::is('back-end.catalog.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Catalogs</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{Route::is('back-end.payable.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('back-end.payable.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Payables <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('back-end.payable.payable')}}" class="nav-link {{Route::is('back-end.payable.payable') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Payables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.payable.receivable')}}" class="nav-link {{Route::is('back-end.payable.receivable') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Receivables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.payable.completed')}}" class="nav-link {{Route::is('back-end.payable.completed.*') || Route::is('back-end.payable.completed') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Route::is('back-end.setting.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('back-end.setting.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.notifications')}}" class="nav-link {{Route::is('back-end.setting.notifications') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Notifications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.bid')}}" class="nav-link {{Route::is('back-end.setting.bid') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Bid</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.images')}}" class="nav-link {{Route::is('back-end.setting.images') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Images</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.ratings')}}" class="nav-link {{Route::is('back-end.setting.ratings') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Ratings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.header-and-footer')}}" class="nav-link {{Route::is('back-end.setting.header-and-footer') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Header & Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.help-centre')}}" class="nav-link {{Route::is('back-end.setting.help-centre') || Route::is('back-end.setting.help-centre-edit') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Help Centre</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.about')}}" class="nav-link {{Route::is('back-end.setting.about') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>About</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('back-end.setting.terms-and-conditions')}}" class="nav-link {{Route::is('back-end.setting.terms-and-conditions') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Terms & Conditions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
</aside>