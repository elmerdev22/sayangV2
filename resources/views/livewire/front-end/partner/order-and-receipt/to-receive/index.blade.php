<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">To Receive/Pick-up</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
        	@include('front-end.includes.datatables.search')
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th class="table-sort" wire:click="sort('orders.order_no')">
                                Order No. 
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.order_no'])
                            </th>
                            <th class="table-sort" wire:click="sort('user_accounts.first_name|user_accounts.last_name')">
                                Buyer Name
                                @include('front-end.includes.datatables.sort', ['field' => 'user_accounts.first_name|user_accounts.last_name'])
                            </th>
                            <th class="table-sort" wire:click="sort('order_items.price')">
                                Amount
                                @include('front-end.includes.datatables.sort', ['field' => 'order_items.price'])
                            </th>
                            <th class="table-sort" wire:click="sort('order_items.quantity')">
                                Quantity
                                @include('front-end.includes.datatables.sort', ['field' => 'order_items.quantity'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.date_payment_confirmed')">
                                Payment Confirmed Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.date_payment_confirmed'])
                            </th>
                            <th class="table-sort" wire:click="sort('order_payments.payment_method')">
                                Payment Method
                                @include('front-end.includes.datatables.sort', ['field' => 'order_payments.payment_method'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.status')">
                                Status
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.status'])
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{$row->order_no}}</td>
                                <td>{{ucwords($row->user_account_first_name.' '.$row->user_account_last_name)}}</td>
                                <td>{{number_format($row->price, 2)}}</td>
                                <td>{{number_format($row->quantity, 0)}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->created_at))}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->date_payment_confirmed))}}</td>
                                <td>
                                    <span class="badge badge-info">{{ucwords(str_replace('_', ' ', $row->payment_method))}}</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">To Receive</span>
                                </td>
                                <td>
                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
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
            @include('front-end.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div> <!-- card.// -->
</div>
