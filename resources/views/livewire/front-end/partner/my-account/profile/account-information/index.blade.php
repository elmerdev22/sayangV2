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
    <div class="text-center mt-1">
        <div class="form-control upload-btn-wrapper btn btn-default btn-sm" style="width: auto; height: 30px;">
            <span class="fas fa-edit"></span> Profile Picture <span wire:loading wire:target="photo" class="fas fa-spinner fa-spin"></span>
            <input type="file" class="upload-btn form-control-file @error('photo') is-invalid @enderror" wire:model="photo" accept="image/*" />
        </div>
    </div>
    <h3 class="profile-username text-center">
        {{ucwords($account->first_name.' '.$account->middle_name.' '.$account->last_name)}}
    </h3>
    <p class="text-muted text-center">
        <span class="badge badge-success">Active</span>
    </p>

    <ul class="list-group list-group-unbordered mb-3 text-sm">
        <li class="list-group-item">
            <b>Username</b> <a class="float-right">
                {{Auth::user()->name}}
            </a>
        </li>
        <li class="list-group-item">
            <b>Email</b> <a class="float-right">
                {{Auth::user()->email}}
            </a>
        </li>
        @if($account->contact_no)
        <li class="list-group-item">
            <b>Contact Number</b> <a class="float-right">
                {{Utility::mobile_number_ph_format($account->contact_no)}}
            </a>
        </li>
        @endif

        @if($account->gender)
        <li class="list-group-item">
            <b>Contact Number</b> <a class="float-right">
                {{Utility::mobile_number_ph_format($account->gender)}}
            </a>
        </li>
        @endif

        @if($account->birth_date)
        <li class="list-group-item">
            <b>Contact Number</b> <a class="float-right">
                {{Utility::mobile_number_ph_format($account->birth_date)}}
            </a>
        </li>
        @endif

        <li class="list-group-item">
            <b>Joined</b> <a class="float-right">
                {{date('F Y', strtotime($account->created_at))}}
            </a>
        </li>
    </ul>

    <a href="#" class="btn btn-warning btn-block"><b>Edit Profile</b></a>
</div>
