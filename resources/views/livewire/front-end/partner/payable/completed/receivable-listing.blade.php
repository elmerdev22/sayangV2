<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Completed Receivables (Orders via E-Wallet & Card)</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body"> 
            @if(count($data) > 0)
                @php $is_collapsed = false; @endphp
                @foreach($data as $row)
                    @php 
                        $payout_total_amount      = 0;
                        $payout_sayang_commission = 0;
                    @endphp
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-warning @if($is_collapsed) collapsed-card @endif">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Payout No. #{{$row->payout_no}} | {{date('M/d/Y', strtotime($row->date_from))}} - {{date('M/d/Y', strtotime($row->date_to))}}
                                        &nbsp; <small><a class="text-blue" href="{{route('front-end.partner.payable.information', ['payout_no' => $row->payout_no])}}" title="View Payout">(Click to View Payout)</a></small>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 m-0" @if($is_collapsed) style="display: none;" @endif>
                                    <div class="table-responsive">

                                        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center m-0">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <th>Order No.</th>
                                                    <th>Buyer Name</th>
                                                    <th>Purchase Date</th>
                                                    <th>Completed Date</th>
                                                    <th>Sayang Commission</th>
                                                    <th>Total Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($component->data_items($row->id) as $order_key => $payout_order)
                                                    @php 
                                                        $order                     = $component->order($payout_order->order_payment_id);
                                                        $order_total               = Utility::order_total($order->order_id);
                                                        $total_amount              = $order_total['total'];
                                                        $sayang_commission         = Utility::sayang_commission($total_amount, $row->commission_percentage);
                                                        $payout_total_amount      += $total_amount;
                                                        $payout_sayang_commission += $sayang_commission['total_commission'];
                                                    @endphp
                                                    <tr>
                                                        <th>{{$order_key+1}}.)</th>
                                                        <td>{{$order->order_no}}</td>
                                                        <td>
                                                            {{ucwords($order->buyer_first_name.' '.$order->buyer_last_name)}}
                                                        </td>
                                                        <td>{{date('M/d/Y', strtotime($order->purchase_date))}}</td>
                                                        <td>{{date('M/d/Y', strtotime($order->date_completed))}}</td>
                                                        <td>PHP {{number_format($sayang_commission['total_commission'], 2)}}</td>                          
                                                        <td>PHP {{number_format($total_amount, 2)}}</td>                          
                                                        <td>
                                                            <a class="btn btn-xs btn-warning" href="{{route('front-end.partner.order-and-receipt.track', ['id' => $order->order_no])}}">Track</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center text-muted" colspan="7">
                                                            No Orders Found
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4" class="text-center">TOTAL</th>
                                                    <th>PHP {{number_format($payout_sayang_commission,2)}}</th>
                                                    <th>PHP {{number_format($payout_total_amount,2)}}</th>
                                                    <th>
                                                        <a class="btn btn-xs btn-warning" href="{{route('front-end.partner.payable.information', ['payout_no' => $row->payout_no])}}">View Payout</a>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>    
                    @php $is_collapsed = true; @endphp
                @endforeach
                <!-- NOTE: Always put the pagination after the .table-responsive class -->
                @include('front-end.includes.datatables.pagination', ['pagination_items' => $data])
            @else
                <h4 class="text-center text-muted">No Completed Payable Found</h4>
            @endif
        </div>
    </div>
</div>

