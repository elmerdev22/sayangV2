<div>
    <form action="POST" wire:submit.prevent="update">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center overflow-hidden">
                    <img class="icon icon-lg rounded-circle border mb-2" src="{{ $photo ? $photo->temporaryUrl() : asset('images/default-photo/image.png')}}" alt="Photo">
                </div>
                <div class="form-group">
                    <label for="photo">Photo*</label>
                    <input type="file" id="photo" class="form-control-file @error('photo') is-invalid @enderror" accept=".jpg, .jpeg, .png" wire:model="photo">
                        <div>
                            <small>File Size: Maximum of 2MB</small>
                        </div>
                    <div>
                        <small>File Extension: .png, .jpeg, .jpeg</small>
                    </div>
                    @error('photo')
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <button wire:target="photo" wire:loading.attr="disabled" type="submit" class="btn btn-primary float-right">
                        Save <span wire:loading wire:target="update" class="fas fa-spinner fa-spin"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('edit_profile_picture_close_modal', param => {
        $('#modal-edit_profile_picture').modal('hide');
    });
</script>
@endpush