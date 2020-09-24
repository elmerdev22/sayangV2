<div class="card-header">
    <h4 class="text-center">Store Details</h4>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-5 text-center">
            <img class="img-fluid mx-auto d-block" style="height:150px" src="{{$user->photo_provider_link ?? asset('images/default-photo/store.png')}}" alt="User profile picture">
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="font-weight-bold">Store Name</label>
                    <p class="text-muted">{{$user->partner_name}}</p>
                </div>
                <div class="col-md-6">
                    <label for="" class="font-weight-bold">Store Contact Number</label>
                    <p class="text-muted">{{$user->partner_contact_no}}</p>
                </div> 
                <div class="col-md-6">
                    <label for="" class="font-weight-bold">Store Address</label>
                    <p class="text-muted">{{($user->partner_city ?? '').(!empty($user->partner_address) ? ', ' : '').($user->partner_address ?? '')}}</p>
                </div> 
                <div class="col-md-6">
                    <label for="" class="font-weight-bold">Started At</label>
                    <p class="text-muted">{{date('Y-m-d',strtotime($user->partner_created_at))}}</p>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success rounded">Payment Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-success">0</span>

                    <div class="info-box-content">
                        <span class="info-box-text">Active Auctions</span>
                        <span class="info-box-number"><a href="#" data-toggle="modal" data-target="#active-auctions-modal" style="text-decoration: underline;">View</a></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning">0</span>

                    <div class="info-box-content">
                        <span class="info-box-text">End Auctions</span>
                        <span class="info-box-number"><a href="#" data-toggle="modal" data-target="#active-auctions-modal" style="text-decoration: underline;">View</a></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger">0</span>

                    <div class="info-box-content">
                        <span class="info-box-text">Cancelled Auctions</span>
                        <span class="info-box-number"><a href="#" data-toggle="modal" data-target="#active-auctions-modal" style="text-decoration: underline;">View</a></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>