<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Orders & Receipts</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>Status</label>
                    <select class="form-control" wire:model="status">
                        <option value="" selected>All</option>
                        <option value="payment_confirmed">Payment Confirmed</option>
                        <option value="to_receive">To Receive</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
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
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.created_at'])
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
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->created_at))}}</td>
                                <td>
                                    @if($row->status == 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @elseif($row->status == 'order_placed')
                                        <span class="badge badge-warning">Order Placed</span>
                                    @elseif($row->status == 'payment_confirmed')
                                        <span class="badge badge-info">Payment Confirmed</span>
                                    @elseif($row->status == 'to_receive')
                                        <span class="badge badge-info">To Receive</span>
                                    @elseif($row->status == 'completed')
                                        <span class="badge badge-success">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
                                </td>
                            </tr>
                        @empty
	        				<tr>
	        					<td colspan="6" class="text-center">No Data Found</td>
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
