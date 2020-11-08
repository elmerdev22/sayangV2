<div>
    <div class="row">
        <div class="col-md-12">            
            <h4>Representative Information
                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#representative_info_edit">
                    <span class="fas fa-edit"></span>
                </button>
            </h4>
        </div>
        <div class="col-lg-12 px-3">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name</label>
                        <div>{{ucwords($partner->representative_first_name.' '.$partner->representative_last_name)}}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Designation</label>
                        <div>{{$partner->representative_designation}}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email</label>
                        <div>{{$partner->representative_email}}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contact No.</label>
                        <div>{{Utility::mobile_number_ph_format($partner->representative_contact_no)}}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Uploaded ID</label>
                        <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/uploaded-id/'.$partner->representative_uploaded_id_file)}}" download="{{$partner->representative_uploaded_id_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Business Information Edit-->
    <div wire:ignore.self class="modal fade" id="representative_info_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Representative Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Content here
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
