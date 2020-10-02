<div>
	<div class="card card-outline card-sayang">
        <div class="card-body box-profile">
            <div class="text-center">
                @php
                    if($data->photo){
                        $photo_url = asset('images/default-photo/account.png');
                    }else if($data->photo_provider_link){
                        $photo_url = $data->photo_provider_link;
                    }else{
                        $photo_url = asset('images/default-photo/account.png');
                    }
                @endphp
                <img class="profile-user-img img-fluid img-circle" src="{{$photo_url}}" alt="User profile picture" style="width: 150px; height: 150px;">
            </div>

            <h3 class="profile-username text-center">{{ucwords($data->first_name.' '.$data->middle_name.' '.$data->last_name)}}</h3>

            <p class="text-muted text-center">Partner/Merchant</p>

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
                    <b>Registered</b> 
                    <a class="float-right">
                        @if($data->created_at)
                            {{date('F/d/Y', strtotime($data->created_at))}}
                        @else
                            <small class="text-muted">Not Set</small>
                        @endif
                    </a>
                </li>
            </ul>
            
            
            <button type="button" @if(!$can_activate) disabled="true" @else onclick="activate()" @endif  class="btn btn-sm btn-block btn-success">
                <i class="fas fa-check"></i> Activate
            </button>

            @if($data->user->is_blocked)
                <button type="button" class="btn btn-sm btn-block btn-success" onclick="change_block_status('Are you sure, do you want to unblock this partner/merchant?')">
                    <i class="fas fa-unlock"></i> Unblock Partner/Merchant
                </button>
            @else
                <button type="button" class="btn btn-sm btn-block btn-danger" onclick="change_block_status('Are you sure, do you want to block this partner/merchant?')">
                    <i class="fas fa-lock"></i> Block Partner/Merchant
                </button>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function activate(){
        Swal.fire({
            title: 'Are you sure, do you want to activate this partner/merchant?',
            text: "You won't be able to revert this!",
            // icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Status...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('activate')
                    }
                });
            }
        })
    }

    function change_block_status(message){
        Swal.fire({
            title: message,
            // text: "You won't be able to revert this!",
            // icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Status...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('change_block_status')
                    }
                });
            }
        })
    }
</script>
@endpush