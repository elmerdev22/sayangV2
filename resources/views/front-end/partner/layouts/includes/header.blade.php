<nav class="main-header navbar navbar-expand sayang-navbar navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                <span class="fa fa-user-circle"></span> 
                @php $account = Utility::auth_user_account(); @endphp
                {{ucwords($account->first_name.' '.$account->last_name)}} 
                <i class="fas fa-caret-down"></i>
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
