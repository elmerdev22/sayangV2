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
            <li class="nav-item dropdown megamenu"><a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle ">Categories</a>
                <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">
                    <div class="container-fluid">
                        <div class="row rounded-0 m-0 shadow-sm">
                            <div class="col-lg-12">
                                <div class="p-4">
                                    <div class="row">
                                        @for($x=0;$x < 11; $x++)
                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <h6 class="font-weight-bold text-uppercase">Category</h6>
                                            <ul class="list-unstyled">
                                            <li class="nav-item"><a href="{{url('/products')}}" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="{{url('/products')}}" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="{{url('/products')}}" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="{{url('/products')}}" class="nav-link text-small pb-0">Sub Category</a></li>
                                            <li class="nav-item"><a href="{{url('/products')}}" class="nav-link text-small pb-0">Sub Category</a></li>
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
              <a class="nav-link" href="{{-- {{url('/help-centre')}} --}}">Help Centre <small class="fas fa-question"></small> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- {{url('/about')}} --}}">About Us <small class="fas fa-info"></small> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/products')}}">Products <small class="fas fa-list"></small> </a>
            </li>
            @if(!Auth::user())
            <li class="nav-item">
              <a class="nav-link" href="{{url('/register/merchant')}}">Be a Partner <small class="fas fa-rocket"></small> </a>
            </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">

            
            @if(Auth::user())

            <div class="widgets-wrap float-md-right">
              <div class="widget-header mr-3">
                <a href="#" class="widget-view" data-tooltip="My Account" data-tooltip-location="bottom">
                  <div class="icon-area">
                    <i class="fa fa-user text-dark"></i>
                  </div>
                </a>
              </div>


              <div class="widget-header mr-3">
                <a href="{{route('account.cart')}}" class="widget-view" data-tooltip="My Cart" data-tooltip-location="bottom">
                  <div class="icon-area">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="notify"><span class="badge badge-warning">0</span></span>
                  </div>
                </a>
              </div>

              <div class="widget-header mr-3">
                 @livewire('front-end.notification')
              </div>
             
              <div class="widget-header mr-3">
                <a class="widget-view" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" data-tooltip="logout" data-tooltip-location="bottom">
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
