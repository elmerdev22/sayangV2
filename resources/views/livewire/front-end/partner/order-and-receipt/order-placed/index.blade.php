<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Order Placed</h5> 
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
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('front-end.includes.datatables.sort', ['field' => 'orders.created_at'])
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
                            @php 
                                $confirmable_data = [
                                    'payment_method' => $row->payment_method,
                                    'status'         => $row->status
                                ];
                                $confirmable = $component->confirmable($confirmable_data);
                                $can_repay   = Utility::order_can_repay($row->id);
                            @endphp
                            <tr>
                                <td>{{$row->order_no}}</td>
                                <td>{{ucwords($row->user_account_first_name.' '.$row->user_account_last_name)}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->created_at))}}</td>
                                <td>
                                    <span class="badge badge-info">{{ucwords(str_replace('_', ' ', $row->payment_method))}}</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Order Placed</span>
                                </td>
                                <td>
                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
                                    @if($confirmable['is_payment_confirmable'] && $can_repay)
                                        <button href="javascript:void(0);" class="btn btn-warning btn-sm">Confirm</button>
                                    @else
                                        <button href="javascript:void(0);" title="Can't confirm (Expired, Item Sold out, Ended)" disabled="true" class="btn btn-warning btn-sm">Confirm</button>
                                    @endif
                                    @if($confirmable['is_cancellable'])
                                        <button href="javascript:void(0);" onclick="cancel_order('{{$row->key_token}}','{{$row->order_no}}')" class="btn btn-danger btn-sm">Cancel</button>
                                    @endif
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
@push('scripts')
<script type="text/javascript">
    function cancel_order(key_token, order_no){
        Swal.fire({
            title: 'Cancel Order?',
            text: "Are you sure you want to cancel this Order No. "+order_no+" ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Cancelling Order...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('cancel_order', key_token)
                    }
                });
            }
        });
    }

    
</script>
@endpush