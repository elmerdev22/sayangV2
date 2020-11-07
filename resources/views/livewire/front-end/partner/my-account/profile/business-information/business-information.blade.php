<div>
    <div class="row">
        <div class="col-md-12">            
            <h4>Business Information
                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#business_information_edit">
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
                        <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/dti-certificates/'.$partner->dti_certificate_file)}}" download="{{$partner->dti_certificate_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                    </div>
                </div>
                <div class="col-12 col-sm-sm-6">
                    <div class="form-group">
                        <label>Address</label>
                        <div>{{Utility::partner_full_address($partner->partner_id)}}</div>
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

    <!-- Modal Business Information Edit-->
    <div wire:ignore.self class="modal fade" id="business_information_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Business Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Business Name</label>
                            <input type="text" class="form-control" wire:model.lazy="name">
                        </div>
                        <div class="col-md-6">
                            <label>Business Contact No.</label>
                            <input type="text" class="form-control" wire:model.lazy="contact_no">
                        </div>
                        <div class="col-md-6">
                            <label>Business Email</label>
                            <input type="email" class="form-control" wire:model.lazy="email">
                        </div>
                        <div class="col-md-6">
                            <label>DTI Registration No.</label>
                            <input type="text" class="form-control" wire:model.lazy="dti_registration_no">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Dipa to tapos</button>
                </div>
            </div>
        </div>
    </div>
</div>
