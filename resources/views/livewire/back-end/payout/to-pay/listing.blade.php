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
                                Total Deducted
                            </th>
                            <th class="table-sort">
                                Total Amount
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{$row->order_no}}</td>
                                <td>{{ucfirst($row->partner_name)}}</td>
                                <td><span class="badge badge-primary"></span>{{str_replace('_', ' ', $row->payment_method)}}</td>
                                @php 
                                    $total_amount     = $component->order_total($row->order_id);
                                    $sayang_comission = Utility::sayang_commision($total_amount);
                                @endphp
                                <td>PHP {{number_format($sayang_comission['total_commission'], 2)}}</td>
                                <td>PHP {{number_format($sayang_comission['total_deducted'], 2)}}</td>
                                <td>PHP {{number_format($total_amount, 2)}}</td>
                                <td>{{date('M/d/Y', strtotime($row->created_at))}}</td>
                                <td>
                                    <a href="{{route('back-end.order-and-receipt.track', ['order_no' => $row->order_no])}}" class="btn btn-warning btn-sm">View Order</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
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
