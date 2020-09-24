<nav class="main-header navbar navbar-expand navbar-warning navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link rounded dropdown-toggle" href="#" id="navbarVersionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarVersionDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Change Password</a>
          <form class="logout" action="{{route('logout')}}" method="post">
            @csrf
            <a class="dropdown-item btn-logout" type="submit">Logout</a>        
          </form>
        </div>
      </li>
    </ul>
</nav>