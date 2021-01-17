<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{UploadUtility::content_photo('logo')}}" height="45" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button"  data-toggle="modal" data-target="#modal_aside_left" class="btn btn-primary" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              @if(Utility::top_nav_validate_auth_verify())
              <li class="nav-item dropdown megamenu">
                  <a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle ">
                    Categories
                  </a>
                  <div aria-labelledby="megamneu" class="dropdown-menu border-0 shadow-sm p-0 m-0">
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="p-4">
                                      @livewire('front-end.header.category', ['type' => 'web'])
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </li>
              @endif
              
              <li class="nav-item">
                  <a class="nav-link" href="{{route('front-end.help-centre.index')}}">Help Centre <small class="fas fa-question"></small> </a>
              </li>

              @if(Utility::top_nav_validate_auth_verify())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('front-end.about-us.index')}}">About Us <small class="fas fa-info"></small> </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('front-end.product.list.index')}}">Products <small class="fas fa-tag"></small> </a>
                </li>
              @endif
              
              @if(!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('partner.register')}}">Be a Partner <small class="fas fa-rocket"></small> </a>
                </li>
              @endif
          </ul>
          <ul class="navbar-nav ml-auto">
              
              @auth
                  <div class="widgets-wrap float-md-right">

                  @if(Auth::user()->type == 'user')
                    <div class="widget-header mr-3">
                      <a href="{{route('front-end.'.Auth::user()->type.'.my-account.index')}}" class="widget-view" data-tooltip="My Account" data-tooltip-location="bottom">
                        <div class="icon-area">
                          <i class="fa fa-user text-dark"></i>
                        </div>
                      </a>
                    </div>

                    @if(Auth::user()->verified_at)
                      <div class="widget-header mr-3">
                        <a href="{{route('front-end.user.my-cart.index')}}" class="widget-view" data-tooltip="My Cart" data-tooltip-location="bottom">
                          <div class="icon-area">
                            <i class="fas fa-shopping-cart text-dark"></i>
                            <span class="notify badge-total-item-in-cart">
                            @php 
                              $total_cart_item = Utility::total_cart_item();
                            @endphp
                              @if($total_cart_item > 0)
                                <span class="badge badge-warning">{{$total_cart_item}}</span>
                              @endif
                            </span>
                          </div>
                        </a>
                      </div>

                      <div class="widget-header mr-3">
                        @livewire('front-end.user.header.notification')
                      </div>
                    @endif
                    
                  @elseif(Auth::user()->type == 'partner')
                    <div class="widget-header mr-3">
                      <a href="{{route('login-redirect.index')}}" class="widget-view" data-tooltip="Dashboard" data-tooltip-location="bottom">
                        <div class="icon-area">
                          <i class="fa fa-tachometer-alt text-dark"></i>
                        </div>
                      </a>
                    </div>
                  @else
                    <div class="widget-header mr-3">
                      <a href="{{route('login-redirect.index')}}" class="widget-view" data-tooltip="Dashboard" data-tooltip-location="bottom">
                        <div class="icon-area">
                          <i class="fa fa-tachometer-alt text-dark"></i>
                        </div>
                      </a>
                    </div>
                  @endif
                  
                    <div class="widget-header mr-3">
                      <a class="widget-view" href="{{route('auth.logout', ['redirect' => 'user_login'])}}" data-tooltip="Logout" data-tooltip-location="bottom">
                        <div class="icon-area">
                          <i class="fas fa-sign-out-alt text-dark"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                
              @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/register')}}">Register </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-warning" href="{{url('/login')}}">Login</a>
                </li>
              @endauth
          </ul>
        </div>
    </div>
</nav>

<div id="modal_aside_left" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <form action="{{route('front-end.product.list.index')}}" method="GET">
          <div class="input-group">
            <input class="form-control form-control-navbar" type="search" name="search" placeholder="Location or Products" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar bg-warning" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          </form>
        </h5>
      </div>
      <div class="modal-body m-0 p-0">
        <nav class="list-group list-group-flush">
          
          @if(Utility::top_nav_validate_auth_verify())
            <a href="#"data-dismiss="modal" data-toggle="modal" data-target="#modal_categories" class="list-group-item"><span class="fas fa-list text-center" style="width: 10%;"></span> Categories</a>
          @endif

          <a href="{{route('front-end.help-centre.index')}}" class="list-group-item {{\Route::is('front-end.help-centre.index') ? 'active':''}}"><span class="fas fa-question text-center" style="width: 10%;"></span> Help Centre</a>
          
          @if(Utility::top_nav_validate_auth_verify())
            <a href="{{route('front-end.about-us.index')}}" class="list-group-item {{\Route::is('front-end.about-us.index') ? 'active':''}}"><span class="fas fa-info text-center" style="width: 10%;"></span> About Us</a>
            <a href="{{route('front-end.product.list.index')}}" class="list-group-item {{\Route::is('front-end.product.list.index') ? 'active':''}}"><span class="fas fa-tag text-center" style="width: 10%;"></span> Products</a>
          @endif
          
          @if(!Auth::check())
            <a href="{{route('partner.register')}}" class="list-group-item {{\Route::is('partner.register') ? 'active':''}}"><span class="fas fa-rocket text-center" style="width: 10%;"></span> Be a Partner</a>
          @endif

          @auth
            @if(Auth::user()->type == 'user')
              <a href="{{route('front-end.'.Auth::user()->type.'.my-account.index')}}" class="list-group-item"><span class="fa fa-user text-center" style="width: 10%;"></span> My Account</a>
              
              @if(Auth::user()->verified_at)
                <a href="{{route('front-end.user.my-cart.index')}}" class="list-group-item {{\Route::is('front-end.user.my-cart.index') ? 'active':''}}"><span class="fa fa-shopping-cart text-center" style="width: 10%;"></span> My Cart</a>
                <a href="{{route('front-end.user.notifications.index')}}" class="list-group-item {{\Route::is('front-end.user.notifications.index') ? 'active':''}}"><span class="fas fa-bell text-center" style="width: 10%;"></span> Notifications</a>
              @endif
            @elseif(Auth::user()->type == 'partner')
              <a href="{{route('login-redirect.index')}}" class="list-group-item"><span class="fa fa-tachometer-alt text-center" style="width: 10%;"></span> Dashboard</a>
            @else
              <a href="{{route('login-redirect.index')}}" class="list-group-item"><span class="fa fa-tachometer-alt text-center" style="width: 10%;"></span> Dashboard</a>
            @endif
            
            <a href="{{route('auth.logout', ['redirect' => 'user_login'])}}" class="list-group-item"><span class="fas fa-sign-out-alt text-center" style="width: 10%;"></span> Logout</a>

          @else
            <a href="{{url('/register')}}" class="list-group-item {{\Request::is('register') ? 'active':''}}"><span class="fas fa-user text-center" style="width: 10%;"></span> Register</a>
            <a href="{{url('/login')}}" class="list-group-item {{\Request::is('login') ? 'active':''}}"><span class="fas fa-sign-in-alt text-center" style="width: 10%;"></span> Login</a>
          @endauth
        </nav>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

<div id="modal_categories" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Categories</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body m-0 p-0">
          @livewire('front-end.header.category', ['type' => 'mobile'])
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->