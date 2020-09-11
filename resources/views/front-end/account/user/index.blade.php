@extends('front-end.layout')
@section('title','My Account')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark">My Account</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="section-content padding-y">
          <div class="row">
            <aside class="col-md-3">
              <!-- menu -->
              <div id="MainMenu">
                <div class="list-group panel">
                  
                  <a href="#account" class="list-group-item active" data-toggle="collapse" data-parent="#MainMenu">
                  <span class="nav-icon fas fa-user"></span> My Account 
                  <i class="fa fa-caret-down"></i></a>
                  <div class="collapse" id="account">
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Profile </a>
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Banks & Cards </a>
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Addresses </a>
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Change password </a>
                  </div>

                  <a href="#dashboard" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu">
                  <span class="nav-icon fas fa-shopping-bag"></span> My Purchase 
                  <i class="fa fa-caret-down"></i></a>
                  <div class="collapse" id="dashboard">
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> To Pay </a>
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Completed </a>
                    <a href="" class="list-group-item"><span class="fas fa-chevron-right mr-1 ml-2"></span> Cancelled </a>
                  </div>

                  <a href="#notification" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu">
                  <span class="nav-icon fas fa-bell"></span> Notifications 
                  <i class="fa fa-caret-down"></i></a>
                  <div class="collapse" id="notification">
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
              </div>
            </aside> <!-- col.// -->
            <main class="col-md-9">
              <div class="card  mb-3">
                <div class="card-header">
                  <h5 class="card-title"> My Profile</h5> 
                </div>
                <div class="card-body">
                  dito yung profile 
                </div> <!-- card-body .// -->
              </div> <!-- card.// -->

            </main> <!-- col.// -->
          </div>

          </div>
      </div><!-- /.container -->
    </div>
    <!-- /.content -->

@endsection
