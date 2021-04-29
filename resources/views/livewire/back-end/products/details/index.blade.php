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
                                <div class="card overflow-hidden">
                                    <div class="position-relative">
                                        <img src="{{$featured_photo}}" class="sayang-card-photo" alt="Product Photo">
                                        {{-- <div class="sayang-featured-photo-overlay">Featured</div> --}}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($data->status == 'active')
                            <div class="col-12 mb-2">
                                <label>Status</label> : 
                                
                                @if (date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($data->date_start)))
                                    <span class="badge badge-success">Active</span>    
                                @else
                                    <span class="badge badge-info">Upcoming</span>    
                                @endif
                            </div>
                            <div class="col-12 mb-2">
                                <a target="_blank" href="{{route('front-end.product.information.redirect', ['slug' => $data->product_slug, 'key_token' => $data->key_token, 'type' => 'buy_now'])}}" class="btn btn-default btn-sm btn-block">View Live Preview <span class="fas fa-eye"></span></a>
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
                        @elseif(($data->status == 'done'))
                            <div class="col-12 mb-2">
                                <label>Status</label> : 
                                <span class="badge badge-danger">Ended</span>    
                            </div>
                            <div class="col-12 mb-2">
                                <div class="bg-danger p-1 text-center">
                                    <span class="fas fa-clock"></span> 
                                    Ended ({{Utility::carbon_diff($data->date_end)}})
                                </div>
                            </div>
                        @elseif(($data->status == 'cancelled'))
                            <div class="col-12 mb-2">
                                <label>Status</label> : 
                                <span class="badge badge-danger">Cancelled</span>    
                            </div>
                            <div class="col-12 mb-2">
                                <div class="bg-danger p-1 text-center">
                                    <span class="fas fa-clock"></span> 
                                    Cancelled ({{Utility::carbon_diff($data->date_cancelled)}})
                                </div>
                            </div>
                        @endif

                        @if ($data->status != 'cancelled')
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
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <label>Regular Price</label>
                            <div>
                                {{number_format($data->regular_price, 2)}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Buy now Price</label>
                            <div>
                                {{number_format($data->buy_now_price, 2)}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Lowest Price</label>
                            <div>
                                {{number_format($data->lowest_price, 2)}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Total Quantity</label>
                            <div>
                                {{number_format($data->total_quantity, 0)}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Total Sold</label>
                            <div>
                                {{number_format(Utility::product_sold($data->id), 0)}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Remaining Quantity</label>
                            <div>
                                {{number_format($data->quantity, 0)}}
                            </div>
                        </div>
                    </div>
                    @if ($data->status == 'cancelled')
                        <hr>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <label>Cancelled By</label>
                                <div>
                                    {{$data->cancelled_by == 'partner' || $data->cancelled_by == null ? 'Partner' : 'Admin (You)'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Cancellation Reason</label>
                                <div>
                                    {{$data->cancellation_reason ? $data->cancellation_reason : 'N/A'}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Date Cancelled</label>
                                <div>
                                    {{date('F/d/Y h:i:s a', strtotime($data->date_cancelled))}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Date Posted</label>
                                <div>
                                    {{date('F/d/Y h:i:s a', strtotime($data->created_at))}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date Start</label>
                                <div>
                                    {{date('F/d/Y h:i:s a', strtotime($data->date_start))}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Date End</label>
                                <div>
                                    {{date('F/d/Y h:i:s a', strtotime($data->date_end))}}
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="row my-4">
                            @if (date('Y-m-d') >= date('Y-m-d', strtotime($data->date_start)))
                            <hr>
                            <div class="col-12">
                                <label>Order History</label>
                            </div>
                            <div class="col-md-7">
                                <p>Order Details</p>
                            </div>
                            <div class="col-md-5 my-2">
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
                                                        <a href="{{route('back-end.order-and-receipt.track', ['order_no' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
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
                                @livewire('front-end.partner.activities.active.bid-ranking-list', ['product_post_id' => $product_post_id, 'quantity' => $data->quantity ])
                            </div>
                            @else 
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- card.// -->
    <!-- Modal -->
    
    @if ($data->status == 'active')
        <div wire:ignore.self class="modal fade" id="cancellation-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form wire:submit.prevent="cancel">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cancellation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        
                                        <label>Cancellation Reason*</label>
                                        <textarea class="form-control" wire:model.lazy="cancellation_reason" placeholder="Input your cancelation reason here..."></textarea>
                                        @error('cancellation_reason') 
                                            <span class="text-danger text-sm">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="cancel" class="fas fa-spinner fa-spin"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@push('scripts')
<script type="text/javascript">
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
        $('#cancellation-modal').modal('show')
    }

	function not_cancellable(name){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Cant`t cancel because this Product already have transactions',
		})
    }
    
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