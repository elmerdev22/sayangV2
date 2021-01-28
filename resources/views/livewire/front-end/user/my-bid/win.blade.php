<div>
    <div class="card card-sayang mb-3 rounded-0">
        <div class="card-header">
            <h5 class="card-title">Win Bids</h5> 
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
                            <th class="table-sort" wire:click="sort('products.name')">
                                Product name
                                @include('front-end.includes.datatables.sort', ['field' => 'products.name'])
                            </th>
                            <!-- <th class="table-sort" wire:click="sort('product_posts.date_start')">
                                Date Start
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_start'])
                            </th> -->
                            <th class="table-sort" wire:click="sort('product_posts.date_end')">
                                Date Ended
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_end'])
                            </th>
                            <th class="text-center">Expiration Date</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ucfirst($row->product_name)}}</td>
                                <!-- <td>{{date('M/d/Y h:iA', strtotime($row->date_start))}}</td> -->
                                <td>{{date('M/d/Y h:iA', strtotime($row->date_end))}}</td>
                                <td>{{date('M/d/Y h:iA', strtotime($row->date_end.' +'.$winning_bid_expiration.' hours'))}}</td>
                                <td>
                                    @if($component->is_expired($row->date_end))
                                        <span class="badge badge-danger">Expired</span>
                                    @elseif($row->order_bid_id)
                                        @if($row->order_status == 'cancelled')
                                            <span class="badge badge-danger">Cancelled</span>
                                        @elseif($row->payment_method == 'cash_on_pickup')
                                            <span class="badge badge-info">Cash on Pickup</span>
                                        @else
                                            @if($row->order_payment_status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-info">{{ucfirst(str_replace('_','-',$row->payment_method))}}</span>
                                            @endif
                                        @endif
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$component->is_expired($row->date_end))
                                        @if($row->order_bid_id)
                                            <a class="btn btn-info btn-sm" href="{{route('front-end.user.my-purchase.track', ['id' => $row->order_no])}}">View Order</a>
                                        @else
                                            <a class="btn btn-warning btn-sm" onclick="pay_now('{{$row->bid_key_token}}')" href="javascript:void(0);">Pay now</a>
                                        @endif
                                    @endif
                                    <a target="_blank" href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->product_key_token, 'type' => 'place_bid'])}}" class="btn btn-warning btn-sm">View</a>
                                </td>
                            </tr>
                        @empty
	        				<tr>
	        					<td colspan="5" class="text-center">No Data Found</td>
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
<script type="text/javascript">
    function pay_now(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Loading Payment...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('pay_now', key_token)
            }
        });
    }

    window.livewire.on('bid_pay_now', param => {
        setTimeout(function (){
            $('#modal-pay_now').modal('show');
            Swal.close();
        }, 3000);
    });
</script>
@endpush