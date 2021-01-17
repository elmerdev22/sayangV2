<div>
    @forelse($data as $data_key => $row)
        @php 
            $payouts       = $component->order_payment_payouts($row->id);
            $payouts_count = $payouts->count();
            $payouts_get   = $payouts->get();
        @endphp
        @if($payouts_count > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card card-warning @if($data_key != 0) collapsed-card @endif">
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
                        <div class="card-body p-0 m-0" @if($data_key != 0) style="display: none;" @endif>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center m-0 p-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px;">#</th>
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
                                                <td class="text-center">{{$payout_key+1}}.)</td>
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
                                                    <a class="btn btn-sm btn-default" href="javascript:void(0);" data-toggle="modal" data-target="#modal-confirm_process_payout">Process</a>
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
        @endif
    @empty
        <h4 class="text-center text-muted">No Pending Payable Found</h4>
    @endforelse
</div>
