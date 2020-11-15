<div>
    @if(!empty($qr_code))
        @if(!empty($data))
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>Buyer name : {{ucwords($data->billing->full_name)}}</label>
                    </div>
                    <div class="col-12">
                        <label>Date purchase : {{date('F/d/Y', strtotime($data->created_at))}}</label>
                    </div>
                    <div class="col-sm-5">
                        <label>Products : {{number_format($data->order_items()->count(), 0)}} items</label>
                    </div>
                    <div class="col-sm-7">
                        <label>
                            Status : 
                            @if($data->status == 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                            @elseif($data->status == 'order_placed')
                                <span class="badge badge-warning">Order Placed</span>
                            @elseif($data->status == 'payment_confirmed')
                                <span class="badge badge-info">Payment Confirmed</span>
                            @elseif($data->status == 'to_receive')
                                <span class="badge badge-info">To Receive</span>
                            @elseif($data->status == 'completed')
                                <span class="badge badge-success">Completed</span>
                            @endif
                        </label>
                    </div>          
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Product name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach($data->order_items()->get() as $item)
                                        <tr>
                                            <td>{{ucfirst($item->product_post->product->name)}}</td>
                                            <td>{{number_format($item->product_post->buy_now_price, 2)}}</td>
                                            <td>{{number_format($item->product_post->quantity, 0)}}</td>
                                            @php 
                                                $sub_total  = $item->product_post->buy_now_price * $item->product_post->quantity;
                                                $total     += $sub_total;
                                            @endphp
                                            <td>{{number_format($sub_total, 2)}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">Total</td>
                                        <td colspan="1">{{number_format($total, 2)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $data->order_no])}}">
                        <i class="fas fa-link"></i> Click here to view full order information
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if($data->status == 'order_placed')
                    <button type="button" class="btn btn-warning" onclick="update_status()">Payment Confirmed</button>
                @elseif($data->status == 'payment_confirmed')
                    <button type="button" class="btn btn-info" onclick="update_status()">Ready to Receive</button>
                @elseif($data->status == 'to_receive')
                    <button type="button" class="btn btn-success" onclick="update_status()">Remark as Completed</button>
                @endif
            </div>
        @endif
    @endif
</div>

@push('scripts')
<script type="text/javascript">
    // $('#modal-qr_result').modal('show');
    load_qr_scanner();
    window.livewire.on('status_updated', param => {
        $('#modal-qr_result').modal("hide");
        if(param['success']){
            Swal.fire({
                icon : 'success',
                title: 'Order Confirmed!',
                text : 'Order No. '+param['order_no']+' remarks as "'+param['new_status']+'".',
            });
        }
    });

    window.livewire.on('scan_result', param => {
        $('#qr-reader-results').show();
        load_qr_scanner();
        if(param['success']){            
            @this.call('render')
            $('#result-order-no').html(param['order_no']);
            setTimeout(() => {
                $('#modal-qr_result').modal("show");
                Swal.close();
            }, 3000);
        }else{
            Swal.fire({
                icon : 'warning',
                title: 'Order Not Found',
            });
        }
    });

    function update_status(){
        Swal.fire({
            title: 'Are you sure do you want to update the status?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Status...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('update_status')
                    }
                });
            }
        })
    }

    function load_qr_scanner(){
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete" || document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function () {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;
            function onScanSuccess(qrCode) {
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Getting Information...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        html5QrcodeScanner.clear();
                        Swal.showLoading();
                        @this.call('scan', qrCode)
                    }
                });
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);
        });
    }
</script>
@endpush