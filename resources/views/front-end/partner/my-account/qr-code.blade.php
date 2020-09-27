@extends('front-end.partner.layouts.layout')
@section('title','QR Code')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Scan QR Code',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Scan QR Code'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title"><span class="fas fa-lock"></span> Scan QR-Code</h5> 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div id="qr-reader" class="w-100"></div>
                            <div id="qr-reader-results"></div>
                            <div id="reader" class="w-100"></div>
                        </div>
                    </div>
                </div> <!-- card-body .// -->
            </div> <!-- card.// -->
        </div>
    </div>
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