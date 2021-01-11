<div>
    <div class="card">
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
                            <th class="table-sort" wire:click="sort('partners.name')">
                                Partner
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.name'])
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
                            <th class="table-sort" wire:click="sort('order_payment_payouts.created_at')">
                                Date Completed
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'order_payment_payouts.created_at'])
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                @endphp
                                <td>{{$row->order_no}}</td>
                                <td>{{ucfirst($row->partner_name)}}</td>
                                <td><span class="badge badge-primary">{{str_replace('_', ' ', $row->payment_method)}}</span></td>
                                <td>PHP {{number_format($sayang_commission['total_commission'], 2)}}</td>
                                <td>PHP {{number_format($total_online_payment_fee, 2)}}</td>
                                <td>PHP {{number_format($net_amount, 2)}}</td>
                                <td>PHP {{number_format($total_amount, 2)}}</td>
                                <td>{{date('M/d/Y', strtotime($row->payout_date))}}</td>
                                <td>
                                    <a href="{{route('back-end.order-and-receipt.track', ['order_no' => $row->order_no])}}" class="btn btn-warning btn-sm">View Order</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- NOTE: Always put the pagination after the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div>
</div>
