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
                    <a href="{{route('back-end.partner.index')}}" class="nav-link {{Route::is('back-end.partner.*') ? 'active':''}}"">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Partners</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.user.index')}}" class="nav-link {{Route::is('back-end.user.*') ? 'active':''}}"">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-end.catalog.index')}}" class="nav-link {{Route::is('back-end.catalog.*') ? 'active':''}}"">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Catalogs</p>
                    </a>
                </li>

            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
</aside>