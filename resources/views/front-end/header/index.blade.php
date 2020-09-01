<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{asset('images/logo/logo.png')}}" height="30" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown megamenu"><a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle ">Categories</a>
                <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">
                    <div class="container">
                        <div class="row rounded-0 m-0 shadow-sm">
                            <div class="col-lg-12">
                                <div class="p-4">
                                    <div class="row">
                                        @for($x=0;$x < 11; $x++)
                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <h6 class="font-weight-bold text-uppercase">Category</h6>
                                            <ul class="list-unstyled">
                                            <li class="nav-item"><a href="" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="" class="nav-link text-small pb-0">Sub Category</a></li>
                                            </ul>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('help-centre')}}">Help Centre <small class="fas fa-question"></small> </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('about')}}">About Us <small class="fas fa-info"></small> </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="">Be a Partner <small class="fas fa-rocket"></small> </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/register')}}">Register </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-outline-warning" href="{{url('/login')}}">Login</a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fas fa-bell"></i>
                  <span class="badge badge-warning navbar-badge float-left">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> --}}
        </ul>
        </div>
    </div>
</nav>
