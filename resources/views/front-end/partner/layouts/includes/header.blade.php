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
                <li>
                    <a href="#" class="dropdown-item sayang-dropdown-item {{Route::is('front-end.partner.my-account.index') ? 'active':''}}">Profile </a>
                </li>
                <li data-toggle="modal" data-target="#change_password">
                    <a href="javascript:void(0);" class="dropdown-item sayang-dropdown-item">Change Password </a>
                </li>
                <li>
                    <a href="{{route('auth.logout', ['redirect' => 'partner_login'])}}" class="dropdown-item sayang-dropdown-item">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- Modal Change Password-->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @livewire('auth.change-password', ['redirect' => 'partner_login'])
            </div>
        </div>
    </div>
</div>
