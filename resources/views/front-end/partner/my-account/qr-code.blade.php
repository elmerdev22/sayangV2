@extends('front-end.layout')
@section('title','Account Activation')
@section('css')

@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark">Scan QR-Code</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Scan QR-Code</li>
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
                  <a href="/merchant/qr-code" class="list-group-item" data-parent="#MainMenu">
                    <span class="fas fa-qrcode"></span> Scan QR CODE 
                  </a>
                </div>
              </div>
            </aside> <!-- col.// -->
            <main class="col-md-9">
              <div class="card  mb-3">
                <div class="card-header">
                  <h5 class="card-title"><span class="fas fa-lock"></span> Scan QR-Code</h5> 
                </div>
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div id="qr-reader" style="width:500px"></div>
                    <div id="qr-reader-results"></div>
                    <div style="width: 500px" id="reader"></div>
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

<script src="{{ asset('template/assets/dist/js/html5-qrcode.min.js') }}"></script>
<script type="text/javascript">

    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
                ++countResults;
                lastResult = qrCodeMessage;
                resultContainer.innerHTML
                    += `<div>[${countResults}] - ${qrCodeMessage}</div>`;
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>  
@endsection