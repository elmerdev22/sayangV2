<div>
    @if (\Auth::check())
        @if (\Auth::user()->type == 'user')
            @if ($follower != null)        
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-warning">
                        <span class="fas fa-check"></span>
                            Followed
                        @if ($follower->is_notify)
                            <span class="fas fa-bell"></span>
                        @else 
                            <span class="fas fa-bell-slash"></span>
                        @endif
                    </button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu dropdown-menu-sm" role="menu">
                                @if ($follower->is_notify)
                                    <a class="dropdown-item sayang-dropdown-item" href="#" wire:click="notification(false)">
                                        <span class="fas fa-bell-slash"></span>
                                        Block Notifications
                                    </a>
                                @else
                                    <a class="dropdown-item sayang-dropdown-item" href="#" wire:click="notification(true)">
                                        <span class="fas fa-bell"></span>
                                        Accept Notifications          
                                    </a>
                                @endif
                                <a class="dropdown-item sayang-dropdown-item" href="#" onclick="unfollow()">
                                    <span class="fas fa-times"></span>
                                    Unfollow
                                </a>
                            </div>
                    </button>
                </div>
            @else
                <button class="btn btn-warning btn-sm" wire:click="follow">
                    <span class="fas fa-plus"></span> Follow
                </button>
            @endif
        @endif
    @else
        <a href="{{url('/login')}}" class="btn btn-warning text-white btn-sm">
            <span class="fas fa-plus"></span> Follow
        </a>
    @endif
</div>
@push('scripts')
<script>
    function unfollow(){

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to unfollow this store/shop ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'    
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('unfollow')
            }
        })

    }
</script>   
@endpush