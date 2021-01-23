<div>
    @php $is_collapsed = true; @endphp
    @forelse($data as $row)
        @php 
            $payouts       = $component->order_payment_payouts($row->id);
            $payouts_count = $payouts->count();
            $payouts_get   = $payouts->get();
        @endphp
        @if($payouts_count > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card card-warning @if(!$is_collapsed) collapsed-card @endif">
                        <div class="card-header">
                            <h3 class="card-title">
                                Batch No. #{{$row->batch_no}} | {{date('M/d/Y', strtotime($row->date_from))}} - {{date('M/d/Y', strtotime($row->date_to))}}
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 m-0" @if(!$is_collapsed) style="display: none;" @endif>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center m-0">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <th>Partner</th>
                                            <th>Payout No</th>
                                            <th>Sayang Commission</th>
                                            <th>Online Payment Fee</th>
                                            <th>Net Amount</th>
                                            <th>Total Amount</th>
                                            <th>Total Orders</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $batch_sayang_commission  = 0;
                                            $batch_online_payment_fee = 0;
                                            $batch_total_net_amount   = 0;
                                            $batch_total_amount       = 0;
                                            $batch_total_orders       = 0;
                                        @endphp
                                        @foreach($payouts_get as $payout_key => $payout)
                                            @php 
                                                $total_orders              = Utility::order_payout_total_orders($payout->id);
                                                $online_payment_fee        = $payout->foreign_fee + $payout->paymongo_fee;
                                                $batch_sayang_commission  += $payout->sayang_commission;
                                                $batch_online_payment_fee += $online_payment_fee;
                                                $batch_total_net_amount   += $payout->net_amount;
                                                $batch_total_amount       += $payout->total_amount;
                                                $batch_total_orders       += $total_orders;
                                            @endphp
                                            <tr>
                                                <th>{{$payout_key+1}}.)</th>
                                                <td>
                                                    <a class="text-blue" target="_blank" href="{{route('back-end.partner.profile', ['key_token' => $payout->partner_account_key_token])}}">
                                                        {{$payout->partner_name}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-blue" href="{{route('back-end.payable.information', ['payout_no' => $payout->payout_no])}}">
                                                        {{$payout->payout_no}}
                                                    </a>
                                                </td>
                                                <td>PHP {{number_format($payout->sayang_commission,2)}}</td>
                                                <td>PHP {{number_format($online_payment_fee,2)}}</td>
                                                <td>PHP {{number_format($payout->net_amount,2)}}</td>
                                                <td>PHP {{number_format($payout->total_amount,2)}}</td>
                                                <td>{{number_format($total_orders)}}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="confirm_process_payout('{{$payout->payout_key_token}}')">Process</a>
                                                    <a class="btn btn-sm btn-warning" href="{{route('back-end.payable.information', ['payout_no' => $payout->payout_no])}}">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="2" class="text-center">TOTAL</th>
                                            <th>PHP {{number_format($batch_sayang_commission,2)}}</th>
                                            <th>PHP {{number_format($batch_online_payment_fee,2)}}</th>
                                            <th>PHP {{number_format($batch_total_net_amount,2)}}</th>
                                            <th>PHP {{number_format($batch_total_amount,2)}}</th>
                                            <th>{{number_format($batch_total_orders)}}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php $is_collapsed = false; @endphp
        @endif
    @empty
        <h4 class="text-center text-muted">No Pending Payable Found</h4>
    @endforelse
</div>
@push('scripts')
<script type="text/javascript">
    function confirm_process_payout(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting Information...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('confirm_process_payout', key_token)
            }
        });
    }
</script>
@endpush
