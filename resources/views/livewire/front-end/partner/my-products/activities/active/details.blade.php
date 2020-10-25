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
                                <div class="bg-danger p-1 text-center">
                                    <span class="fas fa-clock"></span> 4 hrs 3 mins
                                </div>
                            @else
                                <label>Start In</label>
                                <div class="bg-light p-1 text-center">
                                    <span class="fas fa-clock"></span> 4 hrs 3 mins
                                </div>
                            @endif
                        </div>
                        <div class="col-12 mb-2 text-center">
                            <button class="btn btn-danger btn-sm">Cancel this product</button> 
                        </div>
                        <div class="col-12 mb-2">
                            <label>Date Start</label>
                            <div>
                                {{date('F/d/Y', strtotime($data->date_start))}}
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Date End</label>
                            <div>
                                {{date('F/d/Y', strtotime($data->date_end))}}
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Date Added</label>
                            <div>
                                {{date('F/d/Y', strtotime($data->created_at))}}
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-8">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Buy now Price</label>
                            <div>
                                22.00
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Lowest Price</label>
                            <div>
                                26.00
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <form role="form">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control form-control-sm text-center" id="quantity" min="1" value="{{$data->quantity}}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-warning btn-sm" onclick="save_quantity()">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        @if (date('Y-m-d') >= date('Y-m-d', strtotime($data->date_start)))
                        
                        <div class="col-12">
                            <label>Product Sold</label>
                            <p>Buyer Details | Total Sold: 2</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Buyer name</th>
                                            <th>Qty</th>
                                            <th>Date Purchase</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <th>John cena reyes</th>
                                                <td>2</td>
                                                <td>{{date('F/d/Y', strtotime($data->created_at))}}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm">View Invoice</a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            {{-- <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul> --}}
                        </div>
                        <div class="col-12">
                            <label>Product Bids</label>
                            <p>Rankings | Total Bids: 16</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
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
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>100</td>
                                                <td>2</td>
                                                <td>Winning</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
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
<script>
    function save_quantity(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to update the quantity?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.set('product_quantity', $('#quantity').val())
                @this.call('save_quantity')
            }
        })
    }
</script>
@endpush