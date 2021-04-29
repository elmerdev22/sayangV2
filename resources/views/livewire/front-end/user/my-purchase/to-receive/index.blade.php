<div>
    <div class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">To Receive/Pickup</strong>
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
                            <th class="table-sort" wire:click="sort('order_payments.payment_method')">
                                Payment Method
                                @include('front-end.includes.datatables.sort', ['field' => 'order_payments.payment_method'])
                            </th>
                            <th class="table-sort">
                                QR Code
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
                                <td><span class="badge badge-info">{{ucwords(str_replace('_', ' ', $row->payment_method))}}</span></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" onclick="qr_code('{{$row->key_token}}')">
                                        <span class="fas fa-qrcode"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('front-end.user.my-purchase.track', ['id' => $row->order_no])}}" class="btn btn-primary btn-sm">Track</a>
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
<script type="text/javascript">
    function qr_code(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting QR Code...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('qr_code', key_token)
            }
        });
    }
</script>
@endpush