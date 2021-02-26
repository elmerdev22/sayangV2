@extends('front-end.print-preview.layouts.layout')
@section('title', 'Print Invoice: '.$data->order_no)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12 text-right">
                    <a href="javascript:void(0)" onclick="window.print()" class="btn btn-success"><i class="fas fa-print"></i> Print</a>
                    <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button> -->
                </div>
            </div>

            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <img src="{{ UploadUtility::content_photo('logo', false) }}" class="float-left" height="50px">
                        <small class="float-right">Date: {{date('F/d/Y')}}</small>
                    </h4>
                </div>
            <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>{{ucfirst($data->partner->name)}}</strong><br>
                        @if($data->partner->address)
                            {{$data->partner->address}}<br>
                        @endif
                        {{$data->partner->philippine_barangay->name}}, {{$data->partner->philippine_barangay->philippine_city->name}}, <br>
                        {{$data->partner->philippine_barangay->philippine_city->philippine_province->name}}, {{$data->partner->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}<br>

                        Contact No.: {{Utility::mobile_number_ph_format($data->partner->contact_no)}}<br>
        
                        @if($data->partner->email)
                            Email: {{$data->partner->email}}
                        @endif
                    </address>
                </div>
            <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                    <strong>{{ucwords($data->billing->full_name)}}</strong><br>
                        @if($data->billing->address)
                            {{$data->billing->address}}<br>
                        @endif
                        {{$data->billing->philippine_barangay->name}}, {{$data->billing->philippine_barangay->philippine_city->name}}, <br>
                        {{$data->billing->philippine_barangay->philippine_city->philippine_province->name}}, {{$data->billing->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}@if($data->billing->zip_code), {{$data->billing->zip_code}}@endif <br>
                        
                        Contact No.: {{Utility::mobile_number_ph_format($data->billing->contact_no)}}<br>
                        
                        @if($data->billing->email)
                            Email: {{$data->billing->email}}
                        @endif
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Order No. #{{$data->order_no}}</b><br>
                    <br>
                    <b>Billing No.:</b> {{$data->billing->billing_no}}<br>
                    <b>Payment Due:</b> {{date('F/d/Y', strtotime($data->date_payment_confirmed))}}<br>
                    <b>Purchase Completed:</b> {{date('F/d/Y', strtotime($data->date_completed))}}<br>
                    <!-- <b>Account:</b> 968-34567 -->
                    <div class="mt-2 mb-2">
                        {!! QrCode::size(70)->generate($data->qr_code); !!}
                    </div>
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data->order_items()->get() as $row)
                                <tr>
                                    <td>{{ucfirst($row->product_post->product->name)}}</td>
                                    <td>{{$row->quantity}}</td>
                                    <td>₱ {{number_format($row->price, 2)}}</td>
                                    <td>₱ {{number_format($row->price * $row->quantity, 2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
            <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Methods: {{ucwords(str_replace('_', ' ', $data->order_payment->payment_method))}}</p>
                    <div class="row">
                        @if($data->order_payment->payment_method == 'card')
                            <div class="col-6">{{$data->order_payment->card_holder}}</div>
                            <div class="col-6">{{Utility::str_starred($data->order_payment->card_no)}}</div>
                        @elseif($data->order_payment->payment_method == 'e_wallet')
                            <!-- <div class="col-4">{{$data->order_payment->account_name}}</div> -->
                            <!-- <div class="col-4">{{Utility::str_starred($data->order_payment->account_no)}}</div> -->
                            <div class="col-4">{{$data->order_payment->bank->name}}</div>
                        @endif
                    </div>
                </div>
            <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Amount Due {{date('F/d/Y', strtotime($data->date_payment_confirmed))}}</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total:</th>
                                    <td>₱ {{number_format($order_total['total'], 2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
@endsection