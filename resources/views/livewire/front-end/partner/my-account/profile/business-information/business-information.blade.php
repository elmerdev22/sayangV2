<div>
    <div class="row">
        <div class="col-md-12">            
            <h4>Business Information
                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-edit_business_information">
                    <span class="fas fa-edit"></span>
                </button>
            </h4>
        </div>
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
                        <div>
                            <a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/dti-certificates/'.$partner->dti_certificate_file)}}" download="{{$partner->dti_certificate_file_name}}" target="_blank">
                                <i class="fas fa-download"></i> Download File
                            </a>
                            <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-upload_dti_certificate"><i class="fas fa-edit"></i> Upload New</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-sm-6">
                    <div class="form-group">
                        <label>Address</label>
                        <div>{{$full_address}}</div>
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
</div>
