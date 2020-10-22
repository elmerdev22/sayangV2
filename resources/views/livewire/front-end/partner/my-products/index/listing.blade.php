<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> My Product List</h5> 
            <div class="card-tools">
				<a href="{{route('front-end.partner.my-products.add')}}" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Product </a>
				<a href="{{route('front-end.partner.my-products.start-sale')}}" class="btn btn-danger btn-sm"><i class="fas fa-plus"></i> Start a Sale </a>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
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
		        			<th class="table-sort" wire:click="sort('products.buy_now_price')">	
                                Buy Now Price 
		        				@include('front-end.includes.datatables.sort', ['field' => 'products.buy_now_price'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('products.lowest_price')">
		        				Lowest Price 
		        				@include('front-end.includes.datatables.sort', ['field' => 'products.lowest_price'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('products.created_at')">
		        				Date Added
		        				@include('front-end.includes.datatables.sort', ['field' => 'products.created_at'])
		        			</th>
		        			<th class="text-center">
                                Action
                            </th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@forelse($data as $row)
		        			<tr>
		        				<td>{{ucfirst($row->category_name)}}</td>
		        				<td>{{ucfirst($row->name)}}</td>
		        				<td>{{number_format($row->buy_now_price, 2)}}</td>
		        				<td>{{number_format($row->lowest_price, 2)}}</td>
		        				<td>{{date('F/d/Y', strtotime($row->date_added))}}</td>
		        				<td class="text-center">
									<a href="{{route('front-end.partner.my-products.edit', ['slug' => $row->slug])}}" class="btn btn-sm btn-flat btn-default" title="Edit Details"><i class="fas fa-edit"></i></a>
									<a href="javascript:void(0);" onclick="deleteProduct()" class="btn btn-sm btn-flat btn-danger" title="Delete Details"><i class="fas fa-trash"></i></a>
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
