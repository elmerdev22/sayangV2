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
                    <h5 class="card-title"><span class="fas fa-qrcode"></span> Scan QR-Code</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div id="qr-reader" class="w-100"></div>
                            <div id="qr-reader-results"></div>
                            <div id="reader" class="w-100"></div>
                            <div class="py-3 text-center">
                                -OR-
                            </div>
                            <form>
                                <div class="row text-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Order No.</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- card-body .// -->
            </div> <!-- card.// -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-qr_result" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order No. : <span id="result-order-no"></span></h5>
                </div>
                @livewire('front-end.partner.qr-code.index.result')
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('template/assets/dist/js/html5-qrcode.min.js') }}"></script>
@endsection