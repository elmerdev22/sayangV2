<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">{{ucwords($data->product_name)}}</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <label>Featured Photo :</label>
                            @if(!empty($featured_photo))
                                @foreach($featured_photo as $key => $photo)
                                    <div class="card overflow-hidden">
                                        <div class="position-relative">
                                            <img src="{{$photo->getFullUrl('thumb')}}" class="sayang-card-photo" alt="Product Photo">
                                            {{-- <div class="sayang-featured-photo-overlay">Featured</div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-12 mb-2">
                            <label>Status</label> : 
                            @if (date('Y-m-d') >= date('Y-m-d', strtotime($data->date_start)))
                                <span class="badge badge-success">Active</span>    
                            @else
                                <span class="badge badge-info">Upcoming</span>    
                            @endif
                        </div>
                        <div class="col-12 mb-2">
                            @if (date('Y-m-d') >= date('Y-m-d', strtotime($data->date_start)))
                                <label>Time Left</label>
                                <div class="bg-warning p-1 text-center">
                                    <span class="fas fa-clock"></span> 
                                    <span class="countdown">{{$data->date_end}}</span>
                                </div>
                            @else
                                <label>Start In</label>
                                <div class="bg-light p-1 text-center">
                                    <span class="fas fa-clock"></span>
                                    <span class="countdown">{{$data->date_end}}</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 mb-2 text-center">
                            <button class="btn btn-danger btn-sm w-100" @if(!Utility::is_product_post_cancellable($product_post_id)) onclick="not_cancellable()" @else onclick="cancellable()" @endif>Cancel this product</button> 
                        </div>
                        <div class="col-12 mb-2">
                            <label>Date Start</label>
                            <div>
                                {{date('F/d/Y h:i:s a', strtotime($data->date_start))}}
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Date End</label>
                            <div>
                                {{date('F/d/Y h:i:s a', strtotime($data->date_end))}}
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Date Posted</label>
                            <div>
                                {{date('F/d/Y h:i:s a', strtotime($data->created_at))}}
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-8">
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Regular Price</label>
                            <div>
                                {{number_format($data->regular_price, 2)}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Buy now Price</label>
                            <div>
                                {{number_format($data->buy_now_price, 2)}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Lowest Price</label>
                            <div>
                                {{number_format($data->lowest_price, 2)}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Quantity</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-sm text-center" id="quantity" min="1" value="{{$data->quantity}}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="save_quantity()">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if (date('Y-m-d') >= date('Y-m-d', strtotime($data->date_start)))
                        <hr>
                        <div class="col-12">
                            <label>Product Sold</label>
                        </div>
                        <div class="col-md-7">
                            <p>Buyer Details | Total Sold: 2</p>
                        </div>
                        <div class="col-md-5">
                            <input type="search" class="form-control form-control-sm" placeholder="Search Order no." wire:model="search">
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th>Order no.</th>
                                            <th>Purchase Date</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($product_sold as $row)
                                            <tr>
                                                <td>{{$row->order_no}}</td>
                                                <td>{{date('F/d/Y', strtotime($row->created_at))}}</td>
                                                <td>{{number_format($row->product_quantity, 0)}}</td>
                                                <td>
                                                    @if($row->status == 'cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @elseif($row->status == 'order_placed')
                                                        <span class="badge badge-warning">Order Placed</span>
                                                    @elseif($row->status == 'payment_confirmed')
                                                        <span class="badge badge-info">Payment Confirmed</span>
                                                    @elseif($row->status == 'to_receive')
                                                        <span class="badge badge-info">To Receive</span>
                                                    @elseif($row->status == 'completed')
                                                        <span class="badge badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$product_sold->render()}}
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <p>Rankings | Total Bids: {{number_format($bid_ranking_list->total(), 0)}}</p>
                            <table class="table table-bordered table-sm text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Rank</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Bid</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $quan = $data->quantity;    
                                    @endphp
                                    @forelse ($bid_ranking_list as $key => $data)
                                    <tr>
                                        @php
                                            $quan = $quan - $data->quantity;    
                                        @endphp
                                        <td>{{++$key}}</td>
                                        <td>{{$data->user_account->first_name}}</td>
                                        <td>₱{{number_format($data->bid, 2)}}</td>
                                        <td>{{number_format($data->quantity, 0)}}</td>
                                        <td>{{$quan >= 0  ? 'Winning' : 'Losing'}}</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="5">No Bids.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{$bid_ranking_list->render()}}
                        </div>
                        @else 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- card.// -->
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
<script>
    function save_quantity(){
        Swal.fire({
            title             : 'Are you sure?',
            text              : "You want to update the quantity?",
            icon              : 'info',
            showCancelButton  : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Yes!'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.set('product_quantity', $('#quantity').val())
                @this.call('save_quantity')
            }
        })
    }

    function cancellable(){
        Swal.fire({
            title: 'Are you sure do you want to cancel this product?',
            text: "You won't be able to revert this!",
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
                    html              : 'Cancelling ...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('cancel')
                    }
                });
            }
        })
    }

	function not_cancellable(name){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Cant`t cancel because this Product already have transactions',
		})
    }
</script>
@endpush