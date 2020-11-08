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
                @php $account = Utility::auth_user_admin(); @endphp
                {{ucwords($account->first_name.' '.$account->last_name)}} 
                <i class="fas fa-caret-down"></i>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 dropdown-menu-right shadow">
                <li data-toggle="modal" data-target="#change_password">
                    <a href="javascript:void(0);" class="dropdown-item sayang-dropdown-item">Change Password </a>
                </li>
                <li>
                    <a href="{{route('auth.logout', ['redirect' => 'admin_login'])}}" class="dropdown-item sayang-dropdown-item">Logout</a>
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
                @livewire('auth.change-password', ['redirect' => 'admin_login'])
            </div>
        </div>
    </div>
</div>
