<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Active Bids</h5> 
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
                            <th class="table-sort" wire:click="sort('product_posts.date_start')">
                                Date Start
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_start'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.date_end')">
                                Date End
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_end'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.date_end')">
                                Time Left 
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ucfirst($row->product_name)}}</td>
                                <td>{{date('F/d/Y', strtotime($row->date_start))}}</td>
                                <td>{{date('F/d/Y', strtotime($row->date_end))}}</td>
                                <td>
                                    <div class="bg-danger">
                                        <small>
                                            <span class="fas fa-clock"></span> 
                                            <span class="countdown">
                                                {{$row->date_end}}
                                            </span>
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->product_key_token, 'type' => 'place_bid'])}}" class="btn btn-warning btn-sm">View</a>
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
    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $('.countdown').countdown("start");
    });
    $('.countdown').countdown({
        end: function() {
            @this.call('render')
        }
    });
</script>
@endpush