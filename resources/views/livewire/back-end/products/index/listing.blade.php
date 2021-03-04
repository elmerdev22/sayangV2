<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Filter Products</h5> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Partner</label>
                    <select class="form-control" wire:model="partner">
                        <option value="" selected>All</option>
                        @forelse ($partners as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @empty
                            <option>No Partner.</option>    
                        @endforelse
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Order Status</label>
                    <select class="form-control" wire:model="status">
                        <option value="" selected>All</option>
                        <option value="active">Active/Incoming</option>
                        <option value="done">Ended</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Date Start From</label>
                    <input type="date" class="form-control" wire:model="date_from" max="{{$date_to}}">
                    @if(session('date_from_error')) 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{session('date_from_error')}}</span>
                        </span> 
                    @endif
                </div>
                <div class="col-md-6">
                    <label>Date Start To</label>
                    <input type="date" class="form-control" wire:model="date_to" max="{{date('Y-m-d')}}" min="{{$date_from}}">
                    @if(session('date_to_error')) 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{session('date_to_error')}}</span>
                        </span> 
                    @endif
                </div>
            </div>
            @if ($reset_filter)
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-warning w-25" wire:click="reset_filter">Reset Filter <span wire:loading wire:target="reset_filter" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </div>
            @endif
        </div>
    </div> <!-- card.// -->
	<div class="card mb-3">
        <div class="card-body">
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.search')
            <div class="table-responsive my-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        
                        <tr>
                            <th class="table-sort" wire:click="sort('products.name')">
                                Product Name 
                                @include('front-end.includes.datatables.sort', ['field' => 'products.name'])
                            </th>
                            {{-- <th class="table-sort" wire:click="sort('product_posts.regular_price')">	
                                Regular Price 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.regular_price'])
                            </th> --}}
                            <th class="table-sort" wire:click="sort('product_posts.buy_now_price')">	
                                Buy now Price 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.buy_now_price'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.lowest_price')">
                                Lowest Price 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.lowest_price'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.total_quantity')">
                                Total Quantity 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.total_quantity'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.quantity')">
                                Remaining Quantity 
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.quantity'])
                            </th>
                            <th class="table-sort">
                                Total Sold 
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
                                Date Posted
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.created_at'])
                            </th>
                            <th class="table-sort" wire:click="sort('product_posts.status')">
                                Status
                                @include('front-end.includes.datatables.sort', ['field' => 'product_posts.status'])
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
                                <td>{{number_format($row->total_quantity, 0)}}</td>
                                <td>{{number_format($row->quantity, 0)}}</td>
                                <td>{{number_format(Utility::product_sold($row->id), 0)}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->date_start))}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->date_end))}}</td>
                                <td>{{date('M/d/Y h:i:s a', strtotime($row->created_at))}}</td>
                                <td>
                                    @if($row->status == 'active')
                                        @if (date('Y-m-d h:i:s a') >= date('Y-m-d h:i:s a', strtotime($row->date_start)))
                                            <span class="badge badge-warning">Active</span>    
                                        @else
                                            <span class="badge badge-info">Upcoming</span>    
                                        @endif
                                    @elseif($row->status == 'done')
                                        <span class="badge badge-info">Ended</span>
                                    @elseif($row->status == 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="{{route('back-end.products.details', ['key_token' => $row->key_token])}}" class="btn btn-sm btn-flat btn-warning" title="View Details"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Data Found</td>
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
