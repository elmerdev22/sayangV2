<div>
    <form method="POST" wire:submit.prevent="update_date()">
        <div class="row">
            <div class="col-md-6">
                <label for="order_completed_date_from">Orders Completed Date From</label>
                <input type="date" id="order_completed_date_from" class="form-control @error('date_start') is-invalid @enderror" wire:model="date_start" max="{{date('Y-m-d')}}">
                @error('date_start')  
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="order_completed_date_to">Orders Completed Start To</label>
                <input type="date" id="order_completed_date_to" class="form-control @error('date_end') is-invalid @enderror" wire:model="date_end" @if($date_start) min="{{$date_start}}" @endif max="{{date('Y-m-d')}}">
                @error('date_end')  
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>
        <div class="text-right mt-3">
            <div class="form-group">
                <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="update_date">
                    Continue <i class="fas fa-caret-right"></i> <i class="fas fa-spin fa-spinner" wire:loading wire:target="update_date"></i>
                </button>
            </div>
        </div>
    </form>
    <hr>
    @if($date_from && $date_to)
        <div class="form-group">
            <b>ORDER DATE: </b> {{date('M/d/Y', strtotime($date_from))}} - {{date('M/d/Y', strtotime($date_to))}}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
            <thead>
                <tr>
                    <td>#</td>
                    <th>Order No.</th>
                    <th>Buyer Name</th>
                    <th>Completed Date</th>
                    <th>Sayang Commission</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $overall_total_amount     = 0;
                    $overall_total_commission = 0;
                @endphp
                @forelse($data as $key => $row)
                    @php 
                        $order_total               = Utility::order_total($row->order_id)['total'];
                        $order                     = Utility::sayang_commission($order_total);
                        $overall_total_commission += $order['total_commission'];
                        $overall_total_amount     += $order['total_amount'];
                    @endphp
                    <tr>
                        <th>{{$key+1}}.)</th>
                        <td>
                            <a class="text-blue" target="_blank" href="{{route('back-end.order-and-receipt.track', ['order_no' => $row->order_no])}}">{{$row->order_no}}</a>
                        </td>
                        <td>
                            <a class="text-blue" target="_blank" href="{{route('back-end.user.profile', ['key_token' => $row->buyer_key_token])}}">{{ucwords($row->buyer_first_name.' '.$row->buyer_last_name)}}</a>
                        </td>
                        <td>{{date('M/d/Y', strtotime($row->date_completed))}}</td>
                        <td>PHP {{number_format($order['total_commission'],2)}}</td>                          
                        <td>PHP {{number_format($order['total_amount'],2)}}</td>                          
                        <td>
                            <a class="btn btn-sm btn-warning" target="_blank" href="{{route('back-end.order-and-receipt.track', ['order_no' => $row->order_no])}}">Track</a>
                        </td>                          
                    </tr>
                @empty
                    <tr>
                        <td class="text-center text-muted" colspan="7">No Result Found</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th colspan="3" class="text-center">TOTAL</th>
                    <th>PHP {{number_format($overall_total_commission,2)}}</th>
                    <th>PHP {{number_format($overall_total_amount,2)}}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('partner_receivable', param => {
        $('#modal-partner_receivable').modal('show');
        var url = "{{route('back-end.partner.profile', ['key_token' => '|partner_account_key_token|'])}}";
            url = url.replace('|partner_account_key_token|', param['partner_account_key_token']);
        var partner = param['partner_name'];

        $(document).find('#modal-receivable_partner_name').html(`<a href="`+url+`" class="text-blue" target="_blank" title="Click to visit profile">`+partner+`</a>`);
        Swal.close();
    });
</script>
@endpush