<div>
    <div class="text-center">
        <div>
            <img class="profile-user-img img-fluid img-circle" src="{{$photo ? $photo->temporaryUrl() : $old_photo}}" alt="User profile picture" style="width: 100px; height: 100px;">
        </div>
        
        @error('photo')
            <div>
                <small>{{$message}}</small>
            </div>
        @enderror
        
        <small>
            File Size: Maximum of 2MB<br>
            File Extension: .png, .jpeg, .jpeg
        </small>
    </div>
    <div class="text-center mt-1">
        @if ($photo)
            <button class="btn btn-warning btn-sm" wire:click="update_photo">
                <span class="fas fa-check"></span> Save
                <span wire:loading wire:target="update_photo" class="fas fa-spinner fa-spin"></span>
            </button>
            <button class="btn btn-danger btn-sm" wire:click="cancel_upload_photo">
                <span class="fas fa-wrong"></span> Cancel
                <span wire:loading wire:target="cancel_upload_photo" class="fas fa-spinner fa-spin"></span>
            </button>
        @endif  
    </div>
    <div class="text-center mt-1 mb-3">
        <div class="form-control upload-btn-wrapper btn btn-default btn-sm" style="width: auto; height: 30px;">
            <span class="fas fa-edit"></span> Profile Picture <span wire:loading wire:target="photo" class="fas fa-spinner fa-spin"></span>
            <input type="file" class="upload-btn form-control-file @error('photo') is-invalid @enderror" wire:model="photo" accept="image/*" />
        </div>
    </div>

    <ul class="list-group sayang-list-group list-group-unbordered mb-3">
        <li class="list-group-item">
            <b>Status</b> 
            <a class="float-right">
                @if($data->partner)
                    @if($data->partner->is_activated) 
                        <span class="badge badge-success">Activated</span>
                    @else
                        @if($data->partner->status == 'done')
                            <span class="badge badge-info">Activation</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    @endif
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </a>
        </li>
        <li class="list-group-item">
            <b>Firstname</b> 
            <a class="float-right">
                @if($data->first_name)
                    {{ucfirst($data->first_name)}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
        <li class="list-group-item">
            <b>Middlename</b> 
            <a class="float-right">
                @if($data->middle_name)
                    {{ucfirst($data->middle_name)}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
        <li class="list-group-item">
            <b>Lastname</b> 
            <a class="float-right">
                @if($data->last_name)
                    {{ucfirst($data->last_name)}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
        
        <li class="list-group-item">
            <b>Email</b> 
            <a class="float-right">
                @if($data->user->email)
                    {{$data->user->email}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>

        <li class="list-group-item">
            <b>Gender</b> 
            <a class="float-right">
                @if($data->gender)
                    {{ucfirst($data->gender)}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
        <li class="list-group-item">
            <b>Birth Date</b> 
            <a class="float-right">
                @if($data->gender)
                    {{date('F d,Y', strtotime($data->birth_date))}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
        <li class="list-group-item">
            <b>Contact No.</b> 
            <a class="float-right">
                @if($data->contact_no)
                    {{Utility::mobile_number_ph_format($data->contact_no)}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
        <li class="list-group-item">
            <b>Joined</b> 
            <a class="float-right">
                @if($data->created_at)
                    {{date('F d, Y', strtotime($data->created_at))}}
                @else
                    <small class="text-muted">Not Set</small>
                @endif
            </a>
        </li>
    </ul>
    <a href="#" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#account_information_edit"><span class="fas fa-edit"></span> Edit Profile</a>
    <a href="#" class="btn btn-warning btn-sm btn-block"><span class="fas fa-key"></span> Change Password</a>

    
    <!-- Modal Account Information Edit-->
    <div wire:ignore.self class="modal fade" id="account_information_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="update_profile">    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Account Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div>{{$data->user->email}}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Joined</label>
                                    <div>{{date('F d, Y', strtotime($data->created_at))}}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" class="form-control" wire:model.lazy="first_name" placeholder="Firstname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Middlename</label>
                                    <input type="text" class="form-control" wire:model.lazy="middle_name" placeholder="Middlename">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" class="form-control" wire:model.lazy="last_name" placeholder="Lastname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" wire:model.lazy="birth_date">
                                    @error('birth_date')
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact number</label>
                                    <input type="text" class="form-control" wire:model.lazy="contact_no" placeholder="Ex : 09123456789">
                                    @error('contact_no')
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="male" value="male" wire:model="gender">
                                        <label for="male" class="custom-control-label">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input class="custom-control-input" type="radio" id="female" value="female" wire:model="gender">
                                        <label for="female" class="custom-control-label">Female</label>
                                    </div>
                                    @error('gender')
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">
                            Save Changes <span wire:loading wire:target="update_profile" class="fas fa-spinner fa-spin"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
