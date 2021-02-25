
<div class="list-group">
    <article class="list-group-item">
        <header class="filter-header">
            <a href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" class="{{\Route::is('front-end.user.my-account.*') ? '':'text-dark'}}">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">My Account</h6>
            </a>
        </header>
        <div class="collapse {{\Route::is('front-end.user.my-account.*') ? 'show':''}}" id="collapse1" style="">	
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-account.index')}}" class="{{\Route::is('front-end.user.my-account.index') ? 'text-primary':'text-dark'}}">Profile</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-account.banks-and-cards')}}" class="{{\Route::is('front-end.user.my-account.banks-and-cards') ? 'text-primary':'text-dark'}}">Banks & Cards</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-account.addresses')}}" class="{{\Route::is('front-end.user.my-account.addresses') ? 'text-primary':'text-dark'}}">Address</a>
                </li>
                @if (Auth::user()->provider == 'default')
                    <li class="list-group-item">
                        <a href="{{route('front-end.user.my-account.change-password')}}" class="{{\Route::is('front-end.user.my-account.change-password') ? 'text-primary':'text-dark'}}">Change password</a>
                    </li>
                @endif
            </ul>
        </div> <!-- collapse -filter-content  .// -->
    </article>
    <article class="list-group-item">
        <header class="filter-header">
            <a href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" class="{{\Route::is('front-end.user.my-purchase.*') ? '':'text-dark'}}">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">My Purchase</h6>
            </a>
        </header>
        <div class="collapse {{\Route::is('front-end.user.my-purchase.*') ? 'show':''}}" id="collapse2" style="">	
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-purchase.list')}}" class="{{\Route::is('front-end.user.my-purchase.list') ? 'text-primary':'text-dark'}}">List</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-purchase.order-placed')}}" class="{{\Route::is('front-end.user.my-purchase.order-placed') ? 'text-primary':'text-dark'}}">Order Placed</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-purchase.to-receive')}}" class="{{\Route::is('front-end.user.my-purchase.to-receive') ? 'text-primary':'text-dark'}}">To Receive/Pickup</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-purchase.completed')}}" class="{{\Route::is('front-end.user.my-purchase.completed') ? 'text-primary':'text-dark'}}">Completed</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-purchase.cancelled')}}" class="{{\Route::is('front-end.user.my-purchase.cancelled') ? 'text-primary':'text-dark'}}">Cancelled</a>
                </li>
            </ul>
        </div> <!-- collapse -filter-content  .// -->
    </article>
    <article class="list-group-item">
        <header class="filter-header">
            <a href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" class="{{\Route::is('front-end.user.notifications.*') ? '':'text-dark'}}">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">Notifications</h6>
            </a>
        </header>
        <div class="collapse {{\Route::is('front-end.user.notifications.*') ? 'show':''}}" id="collapse3" style="">	
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{route('front-end.user.notifications.index')}}" class="{{\Route::is('front-end.user.notifications.index') ? 'text-primary':'text-dark'}}">Order Updates</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.notifications.activity')}}" class="{{\Route::is('front-end.user.notifications.activity') ? 'text-primary':'text-dark'}}">Activity</a>
                </li>
            </ul>
        </div> <!-- collapse -filter-content  .// -->
    </article>
    <article class="list-group-item">
        <header class="filter-header">
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" class="{{\Route::is('front-end.user.my-bids.*') ? '':'text-dark'}}">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">My Bids</h6>
            </a>
        </header>
        <div class="collapse {{\Route::is('front-end.user.my-bids.*') ? 'show':''}}" id="collapse4" style="">	
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-bids.active')}}" class="{{\Route::is('front-end.user.my-bids.active') ? 'text-primary':'text-dark'}}">Active</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-bids.win')}}" class="{{\Route::is('front-end.user.my-bids.win') ? 'text-primary':'text-dark'}}">Win</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('front-end.user.my-bids.lose')}}" class="{{\Route::is('front-end.user.my-bids.lose') ? 'text-primary':'text-dark'}}">Lose</a>
                </li>
            </ul>
        </div> <!-- collapse -filter-content  .// -->
    </article>
</div>
<br>
<a class="btn btn-light btn-block" href="{{route('auth.logout', ['redirect' => 'user_login'])}}"> <i class="fa fa-power-off"></i> <span class="text">Log out</span> </a> 