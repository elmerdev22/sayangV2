<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Active and Upcoming Sales</h5> 
            <div class="card-tools">
                <a href="{{route('front-end.partner.my-products.start-sale')}}" class="btn btn-danger btn-sm"><i class="fas fa-plus"></i> Start a Sale </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.search')
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
                    <thead>
                        
                        <tr>
                            <th class="table-sort" wire:click="sort('products.name')">
                                Product Name 
                                @include('front-end.includes.datatables.sort', ['field' => 'products.name'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.buy_now_price')">	
                                Buy now Price 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.buy_now_price'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.lowest_price')">
                                Lowest Price 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.lowest_price'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.quantity')">
                                Quantity 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.quantity'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.date_start')">
                                Date Start
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_start'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.date_end')">
                                Date End
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.date_end'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.created_at')">
                                Date Added
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.created_at'])
                            </th>
                            <th class="text-center">
                                Status
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ucfirst($row->product_name)}}</td>
                                <td>{{number_format($row->buy_now_price, 2)}}</td>
                                <td>{{number_format($row->lowest_price, 2)}}</td>
                                <td>{{number_format($row->quantity, 0)}}</td>
                                <td>{{date('F/d/Y', strtotime($row->date_start))}}</td>
                                <td>{{date('F/d/Y', strtotime($row->date_end))}}</td>
                                <td>{{date('F/d/Y', strtotime($row->created_at))}}</td>
                                <td class="text-center">
                                    @if (date('Y-m-d') >= date('Y-m-d', strtotime($row->date_start)))
                                        <span class="badge badge-success">Active</span>    
                                    @else
                                        <span class="badge badge-info">Upcoming</span>    
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('front-end.partner.my-products.activities-details', ['slug' => $row->product_slug ,'key_token' => $row->key_token] )}}" class="btn btn-sm btn-flat btn-warning" title="View Details"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- NOTE: Always put the pagination after the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div> <!-- card.// -->
    
    <!-- Modal -->
    <div class="modal fade" id="editQuantity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Product Name</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control text-center" value="24" min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
