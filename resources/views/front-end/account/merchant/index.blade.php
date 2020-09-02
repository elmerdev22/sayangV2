@extends('front-end.layout')
@section('title','Login')
@section('css')
<style type="text/css">
  a{
    color: black;
  }
</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark"> Account</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account Activation</li>
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
              <ul class="list-group">
                <a class="list-group-item active" href="#"><span class="fas fa-lock"></span> Activate your account  </a>
                <a class="list-group-item" href="#"><span class="nav-icon fas fa-tachometer-alt"></span> My Dashboard </a>
                <a class="list-group-item" href="#"><span class="fas fa-chart-pie mr-1"></span> Ongoing sales </a>
                <a class="list-group-item" href="#"><span class="fas fa-chart-pie mr-1"></span> Completed sales </a>
                <a class="list-group-item" href="#"><span class="fas fa-list"></span> My Items </a>
                <a class="list-group-item" href="#"><span class="fas fa-money-bill"></span> Payments and receipts </a>
                <a class="list-group-item" href="#"><span class="fas fa-qrcode"></span> Scan QR CODE </a>
              </ul>
            </aside> <!-- col.// -->
            <main class="col-md-9">
              <div class="card  mb-3">
                <div class="card-header">
                  <h5 class="card-title"><span class="fas fa-lock"></span> Account Activation 1/5</h5> 
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12"><p>*First things first. Before you can start selling, we would need to know more details about you and your business.</p></div>
                  </div>
                  <div class="row">
                    <div class="col-12"><h4>Business Information</h4></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                    <form role="form">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="business-name">Business name*</label>
                          <input type="text" class="form-control" id="business-name" placeholder="Enter Business name">
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-lg-4">
                              <label for="business-name">Business Address*</label>
                              <input type="text" class="form-control" id="business-name" placeholder="Enter Business name">
                            </div>
                            <div class="col-lg-4">
                              <label for="city">City* </label>
                              <select class="form-control">
                                <option>Select</option>
                              </select>
                            </div>
                            <div class="col-lg-4">
                              <label for="province">Province*</label>
                              <select class="form-control">
                                <option>Select</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="map-link">Google Maps address link*</label>
                          <input type="text" class="form-control" id="map-link" placeholder="Enter Google Maps address link">
                        </div>

                        <div class="form-group">
                          <label for="business-contact-number">Business Contact Number*</label>
                          <input type="text" class="form-control" id="business-name" placeholder="Enter Business Contact Number">
                        </div>

                        <div class="form-group">
                          <label for="business-email-address">Business Email Address*</label>
                          <input type="email" class="form-control" id="business-email-address" placeholder="Enter Business Email Address">
                        </div>

                        <div class="form-group">
                          <label for="dti-registration-number">DTI Registration Number*</label>
                          <input type="text" class="form-control" id="dti-registration-number" placeholder="Enter DTI Registration Number">
                        </div>

                        <div class="form-group">
                          <label for="tin">TIN*</label>
                          <input type="text" class="form-control" id="tin" placeholder="Enter TIN">
                        </div>
                        <div class="form-group">
                          <label for="dti-certificate">Upload DTI Certificate Here*</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="dti-certificate">
                              <label class="custom-file-label" for="dti-certificate">Choose file</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-primary float-right">Proceed to next <span class="fas fa-arrow-right"></span></button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div> <!-- card-body .// -->
              </div> <!-- card.// -->

            </main> <!-- col.// -->
          </div>

          </div>
      </div><!-- /.container -->
    </div>
    <!-- /.content -->



@endsection
