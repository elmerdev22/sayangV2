<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top nav-fixed">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{asset('images/logo/logo.png')}}" height="45" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if(Utility::top_nav_validate_auth_verify())
            <li class="nav-item dropdown megamenu">
              <a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle ">
                Categories
              </a>
                <div aria-labelledby="megamneu" class="dropdown-menu border p-0 m-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-4">
                                    @livewire('front-end.header.category')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endif
            
            <li class="nav-item">
              <a class="nav-link" href="{{-- {{url('/help-centre')}} --}}">Help Centre <small class="fas fa-question"></small> </a>
            </li>

            @if(Utility::top_nav_validate_auth_verify())
              <li class="nav-item">
                <a class="nav-link" href="{{-- {{url('/about')}} --}}">About Us <small class="fas fa-info"></small> </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{url('/products')}}">Products <small class="fas fa-list-alt"></small> </a>
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
                          <span class="notify"><span class="badge badge-warning badge-total-item-in-cart">{{Utility::total_cart_item()}}</span></span>
                        </div>
                      </a>
                    </div>

                    <div class="widget-header mr-3">
                      @livewire('front-end.notification')
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
                    <a class="widget-view" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" data-tooltip="Logout" data-tooltip-location="bottom">
                      <div class="icon-area">
                        <i class="fas fa-sign-out-alt text-dark"></i>
                      </div>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
