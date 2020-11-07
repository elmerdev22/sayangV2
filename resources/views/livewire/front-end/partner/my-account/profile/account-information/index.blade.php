<div>
    @php
        if($account->photo){
            $photo_url = asset('images/default-photo/account.png');
        }else if($account->photo_provider_link){
            $photo_url = $account->photo_provider_link;
        }else{
            $photo_url = asset('images/default-photo/account.png');
        }
    @endphp
    <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="{{$photo_url}}" alt="User profile picture">
    </div>

    <div class="text-center mt-1">
        <button type="button" class="btn btn-default btn-sm">Upload Image</button>
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
