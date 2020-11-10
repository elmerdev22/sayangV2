<div>
    <div class="modal-body">
        <form action="POST" wire:submit.prevent="upload" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="dti_certificate">DTI Certificate* 
                            <span wire:loading wire:target="file, upload" class="fas fa-spinner fa-spin"></span>
                        </label>
                        <input type="file" id="dti_certificate" class="form-control-file @if($error) is-invalid @else @error('file') is-invalid @enderror @endif" accept=".png, .jpeg, .jpg, .gif, .docx, .pdf" wire:model="file">
                        <div>
                            <small>File Size: Maximum of 2MB</small>
                        </div>
                        <div>
                            <small>File Extension: .png, .jpeg, .jpg, .gif, .docx, .pdf</small>
                        </div>
                        @if($error)
                            <span class="invalid-feedback">
                                <span>{{$error}}</span>
                            </span>
                        @else
                            @error('file')
                                <span class="invalid-feedback">
                                    <span>{{$message}}</span>
                                </span>
                            @enderror
                        @endif
                    </div>
                    <div class="form-group mt-2">
                        <button wire:target="file, upload" wire:loading.attr="disabled" type="submit" class="btn btn-warning float-right">
                            Save <span wire:loading wire:target="file, upload" class="fas fa-spinner fa-spin"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
