
<div class="list-group panel rounded-0">
    <a href="#account" class="list-group-item rounded-0 {{\Route::is('front-end.user.my-account.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-user"></span> 
        My Account 
        <i class="fa fa-chevron-left float-right"></i>
    </a>
    
    <div class="collapse rounded-0 {{\Route::is('front-end.user.my-account.*') ? 'show':''}} mb-1" id="account">
        <a href="{{route('front-end.user.my-account.index')}}" class="list-group-item {{\Route::is('front-end.user.my-account.index') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span> 
            Profile 
        </a>
        <a href="{{route('front-end.user.my-account.banks-and-cards')}}" class="list-group-item {{\Route::is('front-end.user.my-account.banks-and-cards') ? 'sayang-link-active':''}}"">
            <span class="far fa-circle mr-1 ml-2"></span> 
            Banks & Cards 
        </a>
        <a href="{{route('front-end.user.my-account.addresses')}}" class="list-group-item {{\Route::is('front-end.user.my-account.addresses') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span> 
            Addresses 
        </a>
        @if (Auth::user()->provider == 'default')
        <a href="{{route('front-end.user.my-account.change-password')}}" class="list-group-item {{\Route::is('front-end.user.my-account.change-password') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span> 
            Change Password 
        </a>
        @endif
    </div>

    <a href="#purchase" class="list-group-item {{\Route::is('front-end.user.my-purchase.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-shopping-bag"></span> My Purchase 
        <i class="fa fa-chevron-left float-right"></i>
    </a>

    <div class="collapse {{\Route::is('front-end.user.my-purchase.*') ? 'show':''}} mb-1" id="purchase">
        <a href="{{route('front-end.user.my-purchase.list')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.list') || \Route::is('front-end.user.my-purchase.list.track') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            List
        </a>
        <a href="{{route('front-end.user.my-purchase.order-placed')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.order-placed') || \Route::is('front-end.user.my-purchase.completed-details') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Order Placed
        </a>
        <a href="{{route('front-end.user.my-purchase.to-receive')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.to-receive') || \Route::is('front-end.user.my-purchase.completed-details') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            To Receive/Pickup
        </a>
        <a href="{{route('front-end.user.my-purchase.completed')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.completed') || \Route::is('front-end.user.my-purchase.completed-details') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Completed
        </a>
        <a href="{{route('front-end.user.my-purchase.cancelled')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.cancelled') || \Route::is('front-end.user.my-purchase.completed-details') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Cancelled
        </a>
    </div>

    <a href="#notification" class="list-group-item {{\Route::is('front-end.user.notifications.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-bell"></span> Notifications 
        <i class="fa fa-chevron-left float-right"></i>
    </a>
    
    <div class="collapse {{\Route::is('front-end.user.notifications.*') ? 'show':''}} mb-1" id="notification">
        <a href="{{route('front-end.user.notifications.index')}}" class="list-group-item {{\Route::is('front-end.user.notifications.index') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Order Updates
        </a>
        <a href="{{route('front-end.user.notifications.activity')}}" class="list-group-item {{\Route::is('front-end.user.notifications.activity') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Activity
        </a>
    </div>
    
    <a href="#bids" class="list-group-item {{\Route::is('front-end.user.my-bids.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-list-alt"></span> My Bids 
        <i class="fa fa-chevron-left float-right"></i>
    </a>

    <div class="collapse {{\Route::is('front-end.user.my-bids.*') ? 'show':''}} mb-1" id="bids">
        <a href="{{route('front-end.user.my-bids.active')}}" class="list-group-item {{\Route::is('front-end.user.my-bids.active') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Active
        </a>
        <a href="{{route('front-end.user.my-bids.win')}}" class="list-group-item {{\Route::is('front-end.user.my-bids.win') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Win
        </a>
        <a href="{{route('front-end.user.my-bids.lose')}}" class="list-group-item {{\Route::is('front-end.user.my-bids.lose') ? 'sayang-link-active':''}}">
            <span class="far fa-circle mr-1 ml-2"></span>
            Lose
        </a>
    </div>

    {{-- <a href="#" class="list-group-item" data-parent="#MainMenu">
        <span class="fas fa-money-bill"></span> My Vouchers  
    </a> --}}
</div>