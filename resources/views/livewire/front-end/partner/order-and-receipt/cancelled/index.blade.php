<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Cancelled</h5> 
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
                            <th>Discount</th>
                            <th>Subtotal</th>
                            <th>Total Price</th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.date_cancelled')">
                                Cancelled Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.date_cancelled'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.status')">
                                Status
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.status'])
                            </th>
                            <th class="text-center">Cancelled By</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            @php
                                $order_total = Utility::order_total($row->id);
                            @endphp
                            <tr>
                                <td>{{$row->order_no}}</td>
                                <td>{{ucwords($row->user_account_first_name.' '.$row->user_account_last_name)}}</td>
                                <td>{{number_format($order_total['total_discount'], 2)}}</td>
                                <td>{{number_format($order_total['sub_total'], 2)}}</td>
                                <td>{{number_format($order_total['total'], 2)}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->created_at))}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->date_cancelled))}}</td>
                                <td>
                                    <span class="badge badge-danger">Cancelled</span>
                                </td>
                                <td>
                                    @if ($row->cancelled_by == 'partner')
                                        You
                                    @elseif($row->cancelled_by == 'user')
                                        Buyer
                                    @else
                                        {{$row->cancelled_by}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
                                </td>
                            </tr>
                        @empty
	        				<tr>
	        					<td colspan="10" class="text-center">No Data Found</td>
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
@push('scripts')
<script>
    window.livewire.hook('afterDomUpdate', () => {
		ExportTable();
    });
</script>
@endpush