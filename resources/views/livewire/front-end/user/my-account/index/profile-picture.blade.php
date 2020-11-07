<div>
    <div class="my-account-profile border-right mb-4">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle m-2" src="{{$photo_url}}" alt="User profile picture" style="width: 100px; height: 100px;">
        </div>
        <div class="text-center">
            <span class="badge badge-success">Active</span>
        </div>
        <div class="text-center mt-1">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-edit_profile_picture">Select Profile</button>
        </div>
        <div class="text-center mt-1">
            <small>
                File size: maximum 2 MB
                <br>
                File extension: .JPEG, .PNG
            </small>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('profile_picture_initialize', param => {
        @this.call('initialize')
    });
</script>
@endpush