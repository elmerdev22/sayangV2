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
                                            <img src="{{$photo->getFullUrl()}}" class="sayang-card-photo" alt="Product Photo">
                                            {{-- <div class="sayang-featured-photo-overlay">Featured</div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
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
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="row my-4">
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
                            <label>Quantity</label>
                            <div>
                                {{number_format($data->quantity, 0)}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Cancelled By</label>
                            <div>
                                {{$data->cancelled_by == 'partner' || $data->cancelled_by == null ? 'Partner (You)' : 'Admin'}}
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