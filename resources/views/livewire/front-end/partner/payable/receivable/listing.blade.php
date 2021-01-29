<div>
    <div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Payout - Pending Receivable - (Orders via Card & E-Wallet)</h4>
        </div>
        <div class="card-body">  
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.search')
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th class="table-sort" wire:click="sort('orders.order_no')">
                                Order No. 
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.order_no'])
                            </th>
                            <th class="table-sort">
                                Payment
                            </th>
                            <th class="table-sort">
                                Sayang Commission
                            </th>
                            <th class="table-sort">
                                Online Payment Fee
                            </th>
                            <th class="table-sort">
                                Net Amount
                            </th>
                            <th class="table-sort">
                                Total Amount
                            </th>
                            <th class="table-sort" wire:click="sort('orders.date_completed')">
                                Date Completed
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.date_completed'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $overall_total_commission = 0;
                            $overall_total_fee        = 0;
                            $overall_total_net_amount = 0;
                            $overall_total_amount     = 0;
                        @endphp
                        @forelse($data as $row)
                            <tr>
                                @php 
                                    $total_amount             = $component->order_total($row->order_id);
                                    $sayang_commission        = Utility::sayang_commission($total_amount);
                                    $total_online_payment_fee = 0;
                                    $net_amount               = $sayang_commission['net_amount'];

                                    if($row->paymongo_payment_id){
                                        $paymongo_commission      = PaymentUtility::paymongo_commission($row->paymongo_payment_id, $row->payment_method);
                                        $online_payment_fee       = $paymongo_commission['fee'];
                                        $foreign_fee              = $paymongo_commission['foreign_fee'];
                                        $net_amount               = $sayang_commission['net_amount'] - ($online_payment_fee + $foreign_fee);
                                        $total_online_payment_fee = $online_payment_fee + $foreign_fee;
                                    }

                                    $overall_total_commission += $sayang_commission['total_commission'];
                                    $overall_total_fee        += $total_online_payment_fee;
                                    $overall_total_net_amount += $net_amount;
                                    $overall_total_amount     += $total_amount;
                                @endphp
                                <td>
                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="text-blue" title="Click here to view order">
                                        {{$row->order_no}}   
                                    </a>
                                </td>
                                <td><span class="badge badge-primary">{{str_replace('_', ' ', $row->payment_method)}}</span></td>
                                <td>PHP {{number_format($sayang_commission['total_commission'], 2)}}</td>
                                <td>PHP {{number_format($total_online_payment_fee, 2)}}</td>
                                <td>PHP {{number_format($net_amount, 2)}}</td>
                                <td>PHP {{number_format($total_amount, 2)}}</td>
                                <td>{{date('M/d/Y', strtotime($row->date_completed))}}</td>
                                <td>{{date('M/d/Y', strtotime($row->created_at))}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">TOTAL</th>
                            <th>PHP {{number_format($overall_total_commission,2)}}</th>
                            <th>PHP {{number_format($overall_total_fee,2)}}</th>
                            <th>PHP {{number_format($overall_total_net_amount,2)}}</th>
                            <th>PHP {{number_format($overall_total_amount,2)}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- NOTE: Always put the pagination after the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div>
</div>