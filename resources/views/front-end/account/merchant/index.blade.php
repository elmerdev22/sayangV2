@extends('front-end.layout')
@section('title','Account Activation')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/stepper.min.css')}}">
@endsection
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
              <!-- menu -->
              <div id="MainMenu">
                <div class="list-group panel">
                  <a href="#" class="list-group-item active" data-parent="#MainMenu">
                    <span class="fas fa-lock"></span> Activate your account  
                  </a>

                  <a href="#dashboard" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu">
                  <span class="nav-icon fas fa-tachometer-alt"></span> My Dashboard 
                  <i class="fa fa-caret-down"></i></a>
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
                  <a href="#" class="list-group-item" data-parent="#MainMenu">
                    <span class="fas fa-qrcode"></span> Scan QR CODE 
                  </a>
                </div>
              </div>
            </aside> <!-- col.// -->
            <main class="col-md-9">
              <div class="card  mb-3">
                <div class="card-header">
                  <h5 class="card-title"><span class="fas fa-lock"></span> Account Activation</h5> 
                </div>
                <div class="card-body">
                  <div id="stepper1" class="bs-stepper linear">
                    <div class="bs-stepper-header" role="tablist">
                      <div class="step active" data-target="#test-l-1">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1" aria-selected="true">
                          <span class="bs-stepper-circle">1</span>
                        </button>
                      </div>
                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-2">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">2</span>
                        </button>
                      </div>
                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-3">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">3</span>
                        </button>
                      </div>
                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-4">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">4</span>
                        </button>
                      </div>
                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-5">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger5" aria-controls="test-l-5" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">5</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <form onsubmit="return false">
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane active dstepper-block" aria-labelledby="stepper1trigger1">
                          <div class="row">
                            <p><span class="fas fa-hand-point-right"></span> First things first. Before you can start selling, we would need to know more details about you and your business.</p>
                          </div>
                          <div class="row">
                            
                            <div class="col-sm-6"><h4>Bank Details</h4></div>
                            <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>

                          </div>
                          <div class="row">
                            <div class="col-12">
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
                              <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Next <span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
                        </div>
                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                          
                          <div class="row">
                            <div class="col-sm-6"><h4>Representative Details</h4></div>
                            <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <label for="firstname">First Name*</label>
                                        <input type="text" class="form-control" id="business-name" placeholder="Enter Firstname">
                                      </div>
                                      <div class="col-lg-6">
                                        <label for="lastname">Last Name*</label>
                                        <input type="text" class="form-control" id="business-name" placeholder="Enter Lastname">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="designation">Designation*</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Designation">
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Email Address*</label>
                                    <input type="email" class="form-control" id="" placeholder="Enter Email Address">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Contact*</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Contact">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Upload ID Here*</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="">
                                        <label class="custom-file-label" for="">Choose file</label>
                                      </div>
                                    </div>
                                  </div>
                              <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
                              <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Next <span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
                        </div>
                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                          
                          <div class="row">
                            <div class="col-sm-6"><h4>Bank Details</h4></div>
                            <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>
                            
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <label for="">Bank*</label>
                                    <select class="form-control">
                                      <option>Select</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-6">
                                    <label for="">Account Name*</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Account Name">
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="">Account Number*</label>
                                <input type="text" class="form-control" id="" placeholder="Enter Account Number">
                              </div>

                              <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
                              <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Next <span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
                        </div>
                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                          
                          <div class="row">
                            <div class="col-12"><h4>Terms and Conditions</h4></div>
                          </div>
                          <div class="row pt-4">
                            <div class="col-12">
                              
                              <h4 class="title text-center">By clicking on the button below, I agree on the TERMS and AGREEMENT of the platform.</h4
                                >
                              <div class="form-group py-4 text-center">
                                <input type="radio" id="agree" name="terms" value="agree">
                                <label for="agree">I Agree to the Terms and Agreement</label><br>
                                <input type="radio" id="disagree" name="terms" value="disagree">
                                <label for="disagree">Disagree and cancel application</label><br>
                              </div>
                              <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
                              <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Next <span class="fas fa-chevron-right"></span></button>

                            </div>
                          </div>
                        </div>
                        <div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
                          <div class="row">
                            <div class="col-12"><h4>Acceptance</h4></div>
                          </div>
                          <div class="row pt-4">
                            <div class="col-12">
                              
                              <h4 class="title text-center pb-4">Congratulations! <br>We've recorded your application. A representative will reach out to you on the status of your application. This process will take 24 hours.</h4
                                >
                              <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Okay <span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
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
@section('js')
<script src="{{asset('template/assets/dist/js/stepper.min.js')}}"></script>
<script type="text/javascript">
var stepper1

document.addEventListener('DOMContentLoaded', function () {
  stepper1 = new Stepper(document.querySelector('#stepper1'))

  var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))

  btnNextList.forEach(function (btn) {
    btn.addEventListener('click', function () {
      stepperForm.next()
    })
  })

})
</script>
@endsection