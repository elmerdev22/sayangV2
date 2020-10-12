<div>
	<div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Representative Information</h4>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            @if(!$representative)
                <h4>No details yet</h4>
            @else
                <div class="row">
                    <div class="col-lg-12 px-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div>{{ucwords($representative->first_name.' '.$representative->last_name)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <div>{{$representative->designation}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div>{{$representative->email}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <div>{{Utility::mobile_number_ph_format($representative->contact_no)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Uploaded ID</label>
                                    <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/uploaded-id/'.$representative->uploaded_id_file)}}" download="{{$representative->uploaded_id_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
