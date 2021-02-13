<div>
    <div class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">Lose Bids</strong>
        </header>
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
                            <th class="table-sort" wire:click="sort('product_posts.date_start')">
                                Date Start
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_start'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.date_end')">
                                Date Ended
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_end'])
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ucfirst($row->product_name)}}</td>
                                <td>{{date('M/d/Y h:iA', strtotime($row->date_start))}}</td>
                                <td>{{date('M/d/Y h:iA', strtotime($row->date_end))}}</td>
                                <td>
                                    <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->product_key_token, 'type' => 'place_bid'])}}" class="btn btn-primary btn-sm">View</a>
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