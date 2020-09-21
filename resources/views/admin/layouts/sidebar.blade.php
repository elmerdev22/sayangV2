
<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <a href="index.html" class="brand-link logo-switch">
      <img src="{{ asset('images/logo/logo.png') }}" alt="Sayang Admin Logo Small" class="brand-image-xl logo-xs">
      <img src="{{ asset('images/logo/logo.png') }}" alt="Sayang Admin Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="{{route('admin.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.cms.partner') }}" class="nav-link">
                  <p>Partner/Merchant</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.cms.user') }}" class="nav-link">
                  <p>User/Buyer</p>
                </a>
              </li>
            </ul>

          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-people-carry"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.cms.catalog') }}" class="nav-link">
                  <p>Catalog</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
</aside>