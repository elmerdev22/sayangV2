<div class="sticky">
	<div class="card card-outline card-sayang ">
        <div class="card-header">
            <h2 class="card-title">
                Account Information
            </h2>
        </div>
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{$photo_url}}" alt="User profile picture" style="width: 150px; height: 150px;">
            </div>

            <h3 class="profile-username text-center">{{ucwords($data->first_name.' '.$data->middle_name.' '.$data->last_name)}}</h3>

            <p class="text-muted text-center">Partner</p>

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
                        
                        @if ($data->user->is_blocked)
                            <span class="badge badge-danger">Blocked</span>
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
                        @if($data->birth_date)
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
                            {{date('F/d/Y', strtotime($data->created_at))}}
                        @else
                            <small class="text-muted">Not Set</small>
                        @endif
                    </a>
                </li>
            </ul>

            <button data-toggle="modal" data-target="#application-progress" class="btn btn-sm btn-block btn-warning">View Activation progress</button>
            
            @if ($application_progress == 4 )
                <button type="button" @if(!$can_activate) disabled="true" @else onclick="activate()" @endif  class="btn btn-sm btn-block btn-warning">
                    <i class="fas fa-check"></i> Activate
                </button>
            @endif

            @if($data->user->is_blocked)
                <button type="button" class="btn btn-sm btn-block btn-default" onclick="change_block_status('Are you sure, do you want to unblock this partner?')">
                    <i class="fas fa-unlock"></i> Unblock Partner
                </button>
            @else
                <button type="button" class="btn btn-sm btn-block btn-danger" onclick="change_block_status('Are you sure, do you want to block this partner?')">
                    <i class="fas fa-lock"></i> Block Partner
                </button>
            @endif
        </div>
    </div>
    <!-- Application Progress Modal -->
    <div wire:ignore.self class="modal fade" id="application-progress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Application Progress</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="track w-100">
                        <div class="step @if($application_progress > 0) active @endif">
                            <span class="icon"> 1 </span> <span class="text">Business Details</span> 
                        </div>
                        <div class="step @if($application_progress > 1) active @endif"> 
                            <span class="icon"> 2 </span> <span class="text">Representative Information</span> 
                        </div>
                        <div class="step @if($application_progress > 2) active @endif"> 
                            <span class="icon"> 3 </span> <span class="text">Bank Details</span>
                        </div>
                        <div class="step @if($application_progress > 3) active @endif"> 
                            <span class="icon"> 4 </span> <span class="text">Completed</span> 
                        </div>
                        <div class="step @if($application_progress > 4) active @endif"> 
                            <span class="icon"> <li class="fas fa-check"></li> </span> <span class="text">Activated</span> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ($application_progress == 4 )
                        <button type="button" @if(!$can_activate) disabled="true" @else onclick="activate()" @endif  class="btn btn-warning">
                            <i class="fas fa-check"></i> Activate
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function activate(){
        Swal.fire({
            title: 'Are you sure, do you want to activate this partner?',
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