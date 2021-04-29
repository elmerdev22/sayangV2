<div>
	<div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Partner Information</h4>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            @if(!$partner)
                <h4>No details yet</h4>
            @else
            
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('{{ $cover_photo }}'); background-repeat: no-repeat; background-size: cover;">
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{$store_photo}}" alt="User Avatar" style="width: 90px; height: 90px;">
                            </div>
                            <div class="card-footer bg-white">
                                <div class="row text-center">
                                    <div class="col-12 pb-3">
                                        <a target="_blank" href="{{route('front-end.profile.partner.index', ['slug' => $slug ])}}" class="btn btn-primary btn-sm">View Live Preview <span class="fa fa-eye"></span></a>
                                    </div>
                                    <div class="col-md-4 border pt-2">
                                        <label>
                                            <span class="fas fa-star"></span> 
                                            <span class="text-muted">Ratings :</span>
                                            <span class="text-warning">{{$ratings}}</span>
                                            {{-- <small>(344 rating)</small> --}}
                                        </label>
                                    </div>
                                    <div class="col-md-4 border pt-2">
                                        <label>
                                            <span class="fas fa-store"></span>
                                            <span class="text-muted">Products :</span>
                                            <span class="text-warning">{{number_format($products, 0)}}</span> 
                                        </label>
                                    </div>
                                    <div class="col-md-4 border pt-2">
                                        <label>
                                            <span class="fas fa-users"></span>
                                            <span class="text-muted">Followers :</span>
                                            <span class="text-warning">{{number_format($followers, 0)}}</span> 
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 px-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <div>{{ucfirst($partner->name)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Business Contact No.</label>
                                    <div>{{Utility::mobile_number_ph_format($partner->contact_no)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Business Email</label>
                                    <div>{{$partner->email}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>DTI Registration No.</label>
                                    <div>{{$partner->dti_registration_no}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>TIN</label>
                                    <div>{{$partner->tin}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Uploaded DTI Certificate</label>
                                    <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/dti-certificates/'.$partner->dti_certificate_file)}}" download="{{$partner->dti_certificate_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <div>{{Utility::partner_full_address($partner->id)}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Map Link</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="text-ellipsis">
                                                <a href="{{$partner->map_address_link}}" target="_blank" class="text-blue">
                                                    {{$partner->map_address_link}}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right">
                                            <button type="button" class="btn btn-xs btn-default" title="Copy Link"><i class="fas fa-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
