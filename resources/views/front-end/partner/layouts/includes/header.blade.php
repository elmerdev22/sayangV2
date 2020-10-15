<nav class="main-header navbar navbar-expand bg-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-bell mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-bell mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-bell mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                <span class="fa fa-user-circle"></span> 
                @php $account = Utility::auth_user_account(); @endphp
                {{-- {{ucwords($account->first_name.' '.$account->last_name)}}  --}}
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 dropdown-menu-right shadow">
                <li><a href="#" class="dropdown-item sayang-dropdown-item {{Route::is('front-end.partner.my-account.index') ? 'active':''}}">Profile </a></li>
                <li data-toggle="modal" data-target="#changepass-modal"><a href="javascript:void(0);" class="dropdown-item sayang-dropdown-item">Change Password </a></li>
                <li>
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
