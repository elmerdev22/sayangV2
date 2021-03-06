<aside class="main-sidebar sidebar-sayang-primary elevation-2">
    <!-- Brand Logo -->
    <a href="/" class="brand-link logo-switch text-center" target="_blank">
        <img src="{{ UploadUtility::content_photo('icon', false) }}" alt="Sayang Admin Logo Small" class="brand-image-xl logo-xs">
        <img src="{{ UploadUtility::content_photo('logo', false) }}" alt="Sayang Admin Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a>
    <!-- Sidebar -->
    <div class="sidebar sayang-sidebar">
        <!-- Sidebar user panel (optional) -->
        @livewire('front-end.partner.sidebar.profile')

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills sayang-nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('front-end.partner.dashboard.index')}}" class="nav-link {{Route::is('front-end.partner.dashboard.index') ? 'sayang-nav-link-active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{Route::is('front-end.partner.my-account.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.my-account.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Account <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-account.index')}}" class="nav-link {{Route::is('front-end.partner.my-account.index') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-account.bank-and-cards')}}" class="nav-link {{Route::is('front-end.partner.my-account.bank-and-cards') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Banks & Cards</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link" data-toggle="modal" data-target="#change_password">
                                <i class="nav-icon fas"></i>
                                <p>Change Password</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{Route::is('front-end.partner.my-products.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.my-products.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>My Products <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-products.list.index')}}" class="nav-link {{Route::is('front-end.partner.my-products.list.index')  ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.my-products.list.add')}}" class="nav-link {{Route::is('front-end.partner.my-products.list.add')  ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Route::is('front-end.partner.activities.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.activities.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Activities <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.activities.active')}}" class="nav-link {{Route::is('front-end.partner.activities.active_details') || Route::is('front-end.partner.activities.active')  ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Active</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.activities.past')}}" class="nav-link {{Route::is('front-end.partner.activities.past_details') || Route::is('front-end.partner.activities.past') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Past</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.activities.cancelled')}}" class="nav-link {{Route::is('front-end.partner.activities.cancelled_details') || Route::is('front-end.partner.activities.cancelled') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Cancelled</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{Route::is('front-end.partner.order-and-receipt.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.order-and-receipt.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Orders & Receipt <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.index')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.index') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>List</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.order-placed')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.order-placed') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Order Placed</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.payment-confirmed')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.payment-confirmed') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Payment Confirmed</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.to-receive')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.to-receive') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>To Receive/Pickup</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.completed')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.completed') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.order-and-receipt.cancelled')}}" class="nav-link {{Route::is('front-end.partner.order-and-receipt.cancelled') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Cancelled</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Route::is('front-end.partner.payable.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.payable.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Payables <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.payable.receivable')}}" class="nav-link {{Route::is('front-end.partner.payable.receivable') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Receivable</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.payable.payable')}}" class="nav-link {{Route::is('front-end.partner.payable.payable') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Payables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.payable.completed')}}" class="nav-link {{Route::is('front-end.partner.payable.completed') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Route::is('front-end.partner.notifications.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('front-end.partner.notifications.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifications <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.notifications.activity')}}" class="nav-link {{Route::is('front-end.partner.notifications.activity') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>
                                    Activity
                                    @if (Utility::notification_count('activity') > 0)
                                        <span class="badge badge-danger right">{{Utility::notification_count('activity')}}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('front-end.partner.notifications.index')}}" class="nav-link {{Route::is('front-end.partner.notifications.index') ? 'sayang-nav-link-active':''}}">
                                <i class="nav-icon fas"></i>
                                <p>
                                    Order Updates
                                    @if (Utility::notification_count('order_updates') > 0)
                                        <span class="badge badge-danger right">{{Utility::notification_count('order_updates')}}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('front-end.partner.qr-code.index')}}" class="nav-link {{\Route::is('front-end.partner.qr-code.index') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-qrcode"></i>
                        <p>Scan QR Code</p>
                    </a>
                </li>
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
</aside>