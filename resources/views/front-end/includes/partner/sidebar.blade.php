<!-- menu -->
<div id="MainMenu">
    <div class="list-group panel">
        @php $is_account_activated = Utility::partner_activated(); @endphp
        @if(!$is_account_activated)
            <a href="{{route('front-end.partner.account-activation.index')}}" class="list-group-item {{\Route::is('front-end.partner.account-activation.index') ? 'active':''}}" data-parent="#MainMenu">
                <span class="fas fa-lock"></span> Activate your account  
            </a>
        @else
            <a href="#account" class="list-group-item {{\Route::is('front-end.partner.my-account.*') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
                <span class="nav-icon fas fa-user"></span> My Account 
                <i class="fa fa-caret-down"></i>
            </a>
            
            <div class="collapse {{\Route::is('front-end.partner.my-account.*') ? 'show':''}}" id="account">
                <a href="{{route('front-end.partner.my-account.index')}}" class="list-group-item {{\Route::is('front-end.partner.my-account.index') ? 'link-active':''}}"><span class="fas fa-chevron-right mr-1 ml-2"></span> Profile </a>
                <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Banks & Cards </a>
                <!-- <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Addresses </a> -->
                <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Change password </a>
            </div>

            <!-- <a href="{{route('front-end.partner.my-account.index')}}" class="list-group-item {{\Route::is('front-end.partner.my-account.index') ? 'active':''}}" data-toggle="collapse" data-parent="#MainMenu">
                <span class="nav-icon fas fa-user"></span> My Account 
                <i class="fa fa-caret-down"></i>
            </a> -->
        @endif
        

        <a href="#dashboard" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu">
            <span class="nav-icon fas fa-tachometer-alt"></span> My Dashboard 
            <i class="fa fa-caret-down"></i>
        </a>
        
        <div class="collapse" id="dashboard">
            <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Ongoing sales </a>
            <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Completed sales </a>
        </div>

        <a href="#" class="list-group-item" data-parent="#MainMenu">
            <span class="fas fa-list"></span> My Items  
        </a>
        <a href="#" class="list-group-item" data-parent="#MainMenu">
            <span class="fas fa-money-bill"></span> Payments and receipts 
        </a>
        <a href="{{route('front-end.partner.qr-code.index')}}" class="list-group-item {{\Route::is('front-end.partner.qr-code.index') ? 'active' : ''}}" data-parent="#MainMenu">
            <span class="fas fa-qrcode"></span> Scan QR CODE 
        </a>
    </div>
</div>