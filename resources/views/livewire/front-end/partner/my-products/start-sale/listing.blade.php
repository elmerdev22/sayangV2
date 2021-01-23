<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
                <h5 class="card-title">My Products List</h5> 
                <div class="card-tools">
                    <a href="javascript:void(0);" onclick="proceed()" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Proceed </a>
                    <a href="{{route('front-end.partner.my-products.list.index')}}" class="btn btn-danger btn-sm">Back </a>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
        <div class="card-body">
        	<!-- NOTE: Always put the show entries & search before the .table-responsive class -->
        	@include('front-end.includes.datatables.search')
        	<div class="table-responsive mt-3">
        		<table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
	        		<thead>
	        			<tr>
	        				<th class="table-sort" wire:click="sort('categories.name')">
	        					Category 
	        					@include('front-end.includes.datatables.sort', ['field' => 'categories.name'])
	        				</th>
		        			<th class="table-sort" wire:click="sort('products.name')">
		        				Product Name 
		        				@include('front-end.includes.datatables.sort', ['field' => 'products.name'])
		        			</th>
		        			<th width="150">
                                Regular Price 
		        			</th>
		        			<th width="150">
                                Buy Now Price 
		        			</th>
		        			<th width="150">
		        				Lowest Price 
		        			</th>
		        			<th width="150" class="text-center">
		        				Quantity
		        			</th>
		        			<th class="text-center">
                                Select
                            </th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@forelse($data as $key => $row)
		        			<tr>
		        				<td>{{ucfirst($row->category_name)}}</td>
                                <td>{{ucfirst($row->name)}}</td>
		        				<td>{{number_format($row->regular_price, 2)}}</td>
		        				<td>
                                    @php 
                                        $buy_now_price = $component->find_selected_product($row->key_token, 'buy_now_price', $row->buy_now_price); 
                                    @endphp
                                    <input type="text" class="form-control form-control-sm mask-money" id="buy-now-price-{{$row->key_token}}" value="{{number_format($buy_now_price,2)}}" onkeyup="select_product('{{$row->key_token}}')">
                                </td>
                                <td>
                                    @php 
                                        $lowest_price = $component->find_selected_product($row->key_token, 'lowest_price', $row->lowest_price); 
                                    @endphp
                                    <input type="text" class="form-control form-control-sm mask-money" id="lowest-price-{{$row->key_token}}" value="{{number_format($lowest_price,2)}}" onkeyup="select_product('{{$row->key_token}}')">
                                </td>
                                <td>
                                    @php 
                                        $quantity = $component->find_selected_product($row->key_token, 'quantity', 1); 
                                    @endphp
                                    <input type="number" class="form-control form-control-sm text-center" min="1" id="quantity-{{$row->key_token}}" value="{{number_format($quantity)}}" onchange="select_product('{{$row->key_token}}')">
                                </td>
                                <td class="text-center">
                                    <div class=""> <!-- icheck-warning - Inalis ko muna yung class nag kaka issue kasi sa responsiveness hehe -->
                                        <input type="checkbox" onclick="select_product('{{$row->key_token}}')" id="select-{{$row->key_token}}" @if($component->find_selected_product($row->key_token, 'is_selected')) checked="true" @endif>
                                        <label for="select-{{$row->key_token}}"></label>
                                    </div>
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
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('.mask-money').mask("#,##0.00", {reverse: true});
    });

    window.livewire.on('initialize_buy_now_price', param => {
        var input_buy_now = $(document).find('#buy-now-price-'+param['key_token']);
        window.setTimeout(() => {
            var current_value = parseFloat(input_buy_now.val());
            if(current_value < param['lowest_price']){
                input_buy_now.val(param['lowest_price']);
            }
        }, 3000);

    });

    function select_product(key_token){
        var doc = $(document);

        var buy_now_price = doc.find('#buy-now-price-'+key_token).val();
        var lowest_price  = doc.find('#lowest-price-'+key_token).val();
        var quantity      = doc.find('#quantity-'+key_token).val();
        var is_selected   = false;

        if(doc.find('#select-'+key_token).is(':checked')){
            is_selected = true;
        }

        var data = {
            key_token    : key_token,
            buy_now_price: buy_now_price,
            lowest_price : lowest_price,
            quantity     : quantity,
            is_selected  : is_selected
        };

        var timeout_id = setTimeout(() => {
            @this.call('select_product', data)
        }, 3000);
    }

    function proceed(){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Loading Data...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                setTimeout(function () {
                    @this.call('proceed')
                },3000)
            }
        });
    }
</script>
@endpush