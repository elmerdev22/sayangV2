<div>
    <div class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">Completed</strong>
        </header>
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
                            <th class="table-sort" wire:click="sort('partners.name')">
                                Seller Name
                                @include('front-end.includes.datatables.sort', ['field' => 'partners.name'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.date_completed')">
                                Completed Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.date_completed'])
                            </th>
                            <th class="table-sort" wire:click="sort('order_payments.payment_method')">
                                Payment Method
                                @include('front-end.includes.datatables.sort', ['field' => 'order_payments.payment_method'])
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{$row->order_no}}</td>
                                <td>{{ucfirst($row->partner_name)}}</td>
                                <td>{{date('M/d/Y h:iA', strtotime($row->created_at))}}</td>
                                <td>{{date('M/d/Y h:iA', strtotime($row->date_completed))}}</td>
                                <td><span class="badge badge-info">{{ucwords(str_replace('_', ' ', $row->payment_method))}}</span></td>
                                <td>
                                    <a href="{{route('front-end.user.my-purchase.track', ['id' => $row->order_no])}}" class="btn btn-primary btn-sm">Track</a>
                                    @if (Utility::is_partner_ratetable($account->id, $row->partner_id, $row->order_id))
                                        <a href="javascript:void(0);" onclick="rate_seller('{{$row->order_no}}')" class="btn btn-light mt-1 btn-sm ">Rate</a>   
                                    @endif
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
    </div>
</div>
@push('scripts')
<script>
    function rate_seller(order_no){
        window.livewire.emit('rate_order_no', order_no);
        $('#rate-seller-modal').modal('show');
    }
</script>
@endpush