

<header class="section-header main-header fixed-top bg-white border-bottom">
    <nav class="navbar navbar-main navbar-expand-lg navbar-light ">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{UploadUtility::content_photo('logo')}}" class="logo">
            </a>
            {{-- <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main_nav2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            <button class="navbar-toggler" data-toggle="modal" data-target="#modal_aside_left" type="button">
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
                    @if (!Auth::check())
                        <div class="text">
                            <a href="{{url('/register')}}" class="btn btn-light"> 
                                <span class="text"> Register </span>
                            </a>
                            <a href="{{url('/login')}}" class="btn btn-primary"> 
                                <span class="text"> Login </span>
                            </a>
                        </div>
                    @else 
                        <a href="{{url('/login')}}" class="widget-header mr-3">
                            <div class="icon">
                                <i class="icon-sm rounded-circle border fa fa-user"></i>
                            </div>
                        </a>
                        <a href="{{route('auth.logout', ['redirect' => 'user_login'])}}" class="widget-header mr-3">
                            <div class="icon">
                                <i class="icon-sm rounded-circle border fa fa-sign-out-alt"></i>
                            </div>
                        </a>
                    @endif
                </div> 
            </div> <!-- navbar-collapse.// -->
        </div> <!-- container.// -->
    </nav>
    
</header>

<div id="modal_aside_left" class="modal fixed-left fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Menu
                </h5>
            </div>
            <div class="modal-body m-0 p-0">
                <nav class="list-group list-group-flush">
                    
                    <a href="{{route('front-end.help-centre.index')}}" class="list-group-item {{\Route::is('front-end.help-centre.index') ? 'active':''}}"><span class="fas fa-question text-center" style="width: 10%;"></span> Help Centre</a>
                    
                    @if(Utility::top_nav_validate_auth_verify())
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
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->