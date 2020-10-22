<div class="list-group panel">
    <a href="#account" class="list-group-item {{\Route::is('front-end.user.my-account.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-user"></span> My Account 
        <i class="fa fa-chevron-left float-right"></i>
    </a>
    
    <div class="collapse {{\Route::is('front-end.user.my-account.*') ? 'show':''}} mb-1" id="account">
        <a href="{{route('front-end.user.my-account.index')}}" class="list-group-item {{\Route::is('front-end.user.my-account.index') ? 'sayang-link-active':''}}"><span class="fas fa-chevron-right mr-1 ml-2"></span> Profile </a>
        <a href="{{route('front-end.user.my-account.banks-and-cards')}}" class="list-group-item {{\Route::is('front-end.user.my-account.banks-and-cards') ? 'sayang-link-active':''}}""><span class="fas fa-chevron-right mr-1 ml-2"></span> Banks & Cards </a>
        <a href="{{route('front-end.user.my-account.addresses')}}" class="list-group-item {{\Route::is('front-end.user.my-account.addresses') ? 'sayang-link-active':''}}"><span class="fas fa-chevron-right mr-1 ml-2"></span> Addresses </a>
        <a href="javascript:void(0);" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Change password </a>
    </div>

    <a href="#purchase" class="list-group-item {{\Route::is('front-end.user.my-purchase.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-shopping-bag"></span> My Purchase 
        <i class="fa fa-chevron-left float-right"></i>
    </a>

    <div class="collapse {{\Route::is('front-end.user.my-purchase.*') ? 'show':''}} mb-1" id="purchase">
        <a href="{{route('front-end.user.my-purchase.list')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.list') || \Route::is('front-end.user.my-purchase.list.track') ? 'sayang-link-active':''}}"><span class="fas fa-chevron-right mr-1 ml-2"></span> List <span class="badge badge-warning text-white right">8</span></a>
        <a href="{{route('front-end.user.my-purchase.completed')}}" class="list-group-item {{\Route::is('front-end.user.my-purchase.completed') || \Route::is('front-end.user.my-purchase.completed-details') ? 'sayang-link-active':''}}"><span class="fas fa-chevron-right mr-1 ml-2"></span>Completed</a>
        <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Cancelled </a>
    </div>

    <a href="#notification" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu">
        <span class="nav-icon fas fa-bell"></span> Notifications 
        <i class="fa fa-chevron-left float-right"></i>
    </a>

    <div class="collapse mb-1" id="notification">
        <a href="" class="list-group-item">
            <span class="fas fa-chevron-right mr-1 ml-2"></span> Order Updates <span class="badge badge-warning text-white right">6</span>
        </a>
        <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Activity </a>
    </div>

    <a href="#" class="list-group-item" data-parent="#MainMenu">
        <span class="fas fa-list-alt"></span> My Bids  
    </a>

    <a href="#" class="list-group-item" data-parent="#MainMenu">
        <span class="fas fa-money-bill"></span> My Vouchers  
    </a>
</div>