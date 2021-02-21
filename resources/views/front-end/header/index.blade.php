

<header class="section-header main-header fixed-top bg-white shadow-sm">
    <nav class="navbar navbar-main navbar-expand-lg navbar-light ">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{UploadUtility::content_photo('logo')}}" class="logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main_nav2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="main_nav2" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="#"> Help Centre </a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('front-end.product.list.index')}}"> Products </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('partner.register')}}"> Be a Partner </a>
                    </li>
                </ul>
                <div class="d-flex justify-content-end">
                    @if (Auth::check() && Auth::user()->type == 'user')
                        <a href="{{route('front-end.user.my-cart.index')}}" class="widget-header mr-3">
                            <div class="icon">
                                <i class="icon-sm rounded-circle border fa fa-shopping-cart"></i>
                                @php 
                                    $total_cart_item = Utility::total_cart_item();
                                @endphp
                                <span class="badge-total-item-in-cart">
                                    @if($total_cart_item > 0)
                                        <span class="notify">{{$total_cart_item}}</span>
                                    @endif
                                </span>
                            </div>
                        </a>
                        <a href="{{route('front-end.user.notifications.index')}}" class="widget-header mr-3">
                            @livewire('front-end.user.header.notification')
                        </a>
                    @endif
                    <div class="widget-header icontext">
                        <a href="{{url('/login')}}" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                        
                        @if (Auth::check())
                            <div class="text">
                                <span class="text-muted">Hi, {{Auth::user()->name}}</span>
                                <div> 
                                    <a href="{{url('/login')}}">My account</a> <span class="dark-transp"> | </span>
                                    <a href="{{route('auth.logout', ['redirect' => 'user_login'])}}"> Logout</a>
                                </div>
                            </div>
                        @else 
                            <div class="text">
                                <span class="text-muted">Welcome guest!</span>
                                <div> 
                                    <a href="{{url('/login')}}">Sign in</a> <span class="dark-transp"> | </span>
                                    <a href="{{url('/register')}}"> Register</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div> 
            </div> <!-- navbar-collapse.// -->
        </div> <!-- container.// -->
    </nav>
</header>