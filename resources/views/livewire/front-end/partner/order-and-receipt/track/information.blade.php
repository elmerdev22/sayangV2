<div>
    <div class="row border p-2 pt-4"> 
        <div class="col-md-7">
            <h6 class="text-muted">Delivery to</h6>
            <p>
                {{ucwords($data->billing->full_name)}}<br>
                Contact No.:  {{Utility::mobile_number_ph_format($data->billing->contact_no)}}<br>
    
                @if($data->billing->email)
                    Email: {{$data->billing->email}} <br>
                @endif
                Location: {{$data->billing->address}} <br>
                {{$data->billing->philippine_barangay->name}}, {{$data->billing->philippine_barangay->philippine_city->name}}, <br>
                {{$data->billing->philippine_barangay->philippine_city->philippine_province->name}}, 
                {{$data->billing->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$data->billing->zip_code}} <br>
            </p>
        </div>
        <div class="col-md-5">
            <h6 class="text-muted">
                Payment @if($data->order_payment->status == 'paid' || $data->order_payment->payment_method == 'cash_on_pickup') <span class="badge badge-info">{{ucwords(str_replace('_', ' ', $data->order_payment->payment_method))}}</span> @endif
                @if($data->order_bid) <span class="badge badge-primary">Order From Win Bid</span> @endif
            </h6>
            @if($data->order_payment->status == 'paid')
                <div>
                    <b>Billing No. :</b> {{$data->billing->billing_no}}
                </div>
                @if($data->order_payment->payment_method == 'card')
                    <div>
                        <i class="fas fa-user"></i> {{$data->order_payment->card_holder}}
                    </div>
                    <div>
                        <i class="fas fa-credit-card"></i> {{Utility::str_starred($data->order_payment->card_no)}}
                    </div>
                @elseif($data->order_payment->payment_method == 'e_wallet')
                    <!-- <div>
                        <i class="fas fa-user"></i> {{$data->order_payment->account_name}}
                    </div>
                    <div>
                        <i class="fas fa-credit-card"></i> {{$data->order_payment->account_no}}
                    </div> -->
                    <div>
                        <i class="fas fa-building"></i> {{$data->order_payment->bank->name}}
                    </div>
                @endif
            @endif

            @if($data->order_payment->status == 'pending')
                <div>
                    <span class="badge badge-warning">
                        <i class="fas fa-spinner"></i> Pending
                    </span>
                </div>
            @elseif($data->order_payment->status == 'paid')
                <div>
                    <span class="badge badge-success">
                        <i class="fas fa-check"></i> Paid
                    </span>
                </div>
            @elseif($data->order_payment->status == 'cancelled')
                <div>
                    <span class="badge badge-danger">
                        <i class="fas fa-times"></i> Cancelled
                    </span>
                    <small>
                    ( Cancelled by 
                    @if($data->cancelled_by)
                        @if($data->cancelled_by == 'partner') you @elseif($data->cancelled_by == 'user') buyer @else sayang @endif
                    @endif)
                    </small>
                </div>
            @endif

            <p>
                Subtotal: ₱ {{number_format($order_total['sub_total'], 2)}} <br>
                Discount:  ₱ {{number_format($order_total['total_discount'], 2)}} <br>
                <strong>Total Price: ₱ {{number_format($order_total['total'], 2)}} </strong>
            </p>

            @if($is_payment_confirmable)
                @if($can_repay)
                    <a class="btn btn-sm btn-warning" href="javascript:void(0);" onclick="payment_confirmed()">
                        CONFIRM
                    </a>
                @else
                    @if(!$data->order_bid)
                        <b>Note:</b> This order was expired, because one or more of the items in this order was ended or soldout.
                    @endif
                @endif
            @endif
            @if($is_remarkable_as_paid)
                <!-- <a class="btn btn-sm btn-warning" href="javascript:void(0);" onclick="remark_as_paid()">
                    REMARK AS PAID
                </a> -->
            @endif
            @if($is_cancellable)
                <a class="btn btn-sm btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal-cancel_order">
                    CANCEL ORDER
                </a>
            @endif

            <div class="row">
                <!-- @if($data->order_payment->status == 'paid')
                    <div class="col-6">
                        QR Code : <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);" onclick="qr_code('{{$data->key_token}}')"><span class="fas fa-qrcode"></span></a>
                    </div>
                @endif -->
                @if($data->status == 'completed')
                    <div class="col-6">
                        View Invoice : <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);" data-toggle="modal" data-target="#modal-invoice"><span class="fas fa-file-invoice"></span></a>
                    </div>
                @endif
                @if($data->status == 'cancelled')
                    <div class="col-12">
                        <div>
                            <b>Cancelation Reason: </b> <br> {{ucfirst($data->cancelation_reason)}}
                        </div>
                        <div>
                            <small class="text-muted">{{date('F/d/Y h:iA', strtotime($data->date_cancelled))}}</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div> <!-- row.// -->
</div>

@push('scripts')
<script type="text/javascript">
    function qr_code(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting QR Code...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('qr_code', key_token)
            }
        });
    }

    function payment_confirmed(){
        Swal.fire({
            title: 'Are you sure do you want to confirm this order?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Status...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('payment_confirmed')
                    }
                });
            }
        })
    }

    function remark_as_paid(){
        Swal.fire({
            title: 'Are you sure do you want to remark this order as paid?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Payment Status...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('remark_as_paid')
                    }
                });
            }
        })
    }
</script>
@endpush