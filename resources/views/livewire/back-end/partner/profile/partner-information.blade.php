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
