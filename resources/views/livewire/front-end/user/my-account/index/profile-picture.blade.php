<div>
    <div class="my-account-profile border-right mb-4">
        <div class="text-center">
            <img class="icon icon-lg rounded-circle border m-2" src="{{$photo_url}}" alt="" style="width: 120px; height: 120px;">
        </div>
        <div class="text-center mt-1">
            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-edit_profile_picture">Select Profile</button>
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