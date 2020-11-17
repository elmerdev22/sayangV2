<div>
    <div class="row border p-2 pt-4"> 
        <div class="col-md-8">
            <h6 class="text-muted">Delivery To</h6>
            <p>
                <a href="{{route('back-end.user.profile', ['key_token' => $data->billing->user_account->key_token])}}" class="text-blue" title="Click to view profile">{{ucwords($data->billing->full_name)}}</a><br>
                Contact No.:  {{Utility::mobile_number_ph_format($data->billing->contact_no)}}<br>
    
                @if($data->billing->email)
                    Email: {{$data->billing->email}} <br>
                @endif
                Location: {{$data->billing->address}} <br>
                {{$data->billing->philippine_barangay->name}}, {{$data->billing->philippine_barangay->philippine_city->name}}, <br>
                {{$data->billing->philippine_barangay->philippine_city->philippine_province->name}}, 
                {{$data->billing->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$data->billing->zip_code}} <br>
            </p>
            <hr>
            <h6 class="text-muted">Delivery From</h6>
            <p>
                <a href="{{route('back-end.partner.profile', ['key_token' => $data->partner->user_account->key_token])}}" class="text-blue" title="Click to view profile">{{ucfirst($data->partner->name)}}</a><br>
                Contact No.:  {{Utility::mobile_number_ph_format($data->partner->contact_no)}}<br>
                @if($data->partner->email)
                    Email: {{$data->partner->email}} <br>
                @endif

                Location: {{$data->partner->address}} <br>
                {{$data->partner->philippine_barangay->name}}, {{$data->partner->philippine_barangay->philippine_city->name}}, <br>
                {{$data->partner->philippine_barangay->philippine_city->philippine_province->name}}, 
                {{$data->partner->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}@if($data->partner->zip_code), {{$data->partner->zip_code}} @endif<br>
            </p>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted">
                Payment <span class="badge badge-info">{{ucwords(str_replace('_', ' ', $data->order_payment->payment_method))}}</span>
            </h6>
            @if($data->order_payment->payment_method == 'card')
                <div>
                    <i class="fas fa-user"></i> {{$data->order_payment->card_holder}}
                </div>
                <div>
                    <i class="fas fa-credit-card"></i> {{$data->order_payment->card_no}}
                </div>
            @elseif($data->order_payment->payment_method == 'e_wallet')
                <div>
                    <i class="fas fa-user"></i> {{$data->order_payment->account_name}}
                </div>
                <div>
                    <i class="fas fa-credit-card"></i> {{$data->order_payment->account_no}}
                </div>
                <div>
                    <i class="fas fa-building"></i> {{$data->order_payment->bank->name}}
                </div>
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
                </div>
            @endif
            <p>
                Subtotal: ₱ {{number_format($order_total['sub_total'], 2)}} <br>
                Discount:  ₱ {{number_format($order_total['total_discount'], 2)}} <br>
                <strong>Total Price: ₱ {{number_format($order_total['total'], 2)}} </strong>
            </p>
        </div>
        
        {{-- <div class="col-md-8">
            QR Code : <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);" onclick="qr_code('{{$data->key_token}}')"><span class="fas fa-qrcode"></span></a>
        </div> --}}
        @if($data->status == 'completed')
            <div class="col-md-4">
                View Invoice : <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);" data-toggle="modal" data-target="#modal-invoice"><span class="fas fa-file-invoice"></span></a>
            </div>
        @endif
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
</script>
@endpush