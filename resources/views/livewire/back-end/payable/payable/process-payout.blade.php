<div>
    @if($date_from && $date_to)
        <hr>
        <div class="form-group">
            <b>ORDER DATE: </b> {{date('M/d/Y', strtotime($date_from))}} - {{date('M/d/Y', strtotime($date_to))}}
        </div>
        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
            <thead>
                <tr>
                    <th>Partner</th>
                    <th>Sayang Commission</th>
                    <th>Online Payment Fee</th>
                    <th>Net Amount</th>
                    <th>Total Amount</th>
                    <th>Total Orders</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                    <tr>
                        <td>
                            <a class="text-blue" target="_blank" href="{{route('back-end.partner.profile', ['key_token' => $row['partner_account_key_token']])}}">
                                {{ucfirst($row['partner_name'])}}
                            </a>
                        </td>
                        <td>PHP {{number_format($row['sayang_commission'],2)}}</td>
                        <td>PHP {{number_format($row['online_payment_fee'],2)}}</td>
                        <td>PHP {{number_format($row['net_amount'],2)}}</td>
                        <td>PHP {{number_format($row['total_amount'],2)}}</td>                            
                        <td>{{number_format($row['total_orders'])}}</td>
                        <td>
                            <div class="icheck-warning">
                                <input type="checkbox" id="select-{{$row['partner_key_token']}}" class="select-payout" data-key_token="{{$row['partner_key_token']}}" checked="true">
                                <label for="select-{{$row['partner_key_token']}}"></label>
                            </div>
                        </td>                            
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No Result Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(!empty($data))
            <div class="text-right mt-3">
                <div class="form-group">
                    <button type="button" data-dismiss="modal" wire:loading.attr="disabled" wire:target="process" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancel</button>
                    <button type="button" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="process" onclick="process()"><i class="fas fa-check"></i> Submit</button>
                </div>
            </div>
        @endif
    @endif
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('initialize_process_payout_listing', param => {
        $('#modal-process_payout').modal('hide');    
    });

    function process(){
        Swal.fire({
            title: 'Are you sure, do you want to proces this payout?',
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
                    html              : 'Processing...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        var key_tokens = [];
                        $(document).find('.select-payout').each(function (){
                            if($(this).is(':checked')){
                                if(typeof $(this).data('key_token') !== 'undefined') {
                                    var key_token = $(this).data('key_token'); 
                                    if(key_token != ''){
                                        key_tokens.push(key_token);
                                    }
                                }
                            }
                        });
                        Swal.showLoading();
                        @this.call('process', key_tokens)
                    }
                });
            }
        })
    }
</script>
@endpush