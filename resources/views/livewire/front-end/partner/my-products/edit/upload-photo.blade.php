<div>
    <form action="POST" wire:submit.prevent="upload">
        <div class="row">
            @if(!empty($photos))
                @foreach($photos as $key => $photo)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card overflow-hidden sayang-photo-bordered">
                            <div class="position-relative">
                                <img src="{{ UploadUtility::livewire_tmp_url($photo) }}" class="sayang-card-photo" alt="Product Photo">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div wire:loading wire:target="upload" class="text-success">
                    <span class="fas fa-spinner fa-spin"></span> Uploading Please Wait...
                </div>
                <div class="form-group">
                    <label for="photos">Upload Photos</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photos" accept=".png, .jpeg, .jpg, .gif, .docx, .pdf" wire:model="photos" multiple>
                            <label class="custom-file-label" for="photos">
                                @if($photos) 
                                    @if(count($this->photos) > 0)
                                        {{count($this->photos)}} Photos Selected 
                                    @else
                                        No Photo Selected
                                    @endif    
                                @else 
                                    No Photo Selected 
                                @endif
                            </label>
                        </div>
                    </div>
                    <div>
                        <small>File Size: Maximum of 1MB</small>
                    </div>
                    <div>
                        <small>File Extension: .png, .jpeg, .jpeg</small>
                    </div>
                    @if(empty($photos))
                        @error('photos')
                            <span class="invalid-feedback d-block">
                                <span>{{$message}}</span>
                            </span>
                        @enderror
                    @else
                        @error('photos.*')
                            <span class="invalid-feedback d-block">
                                <span>{{$message}}</span>
                            </span>
                        @enderror
                    @endif
                    <div class="form-group mt-2">
                        <button wire:target="photos, upload" wire:loading.attr="disabled" type="submit" class="btn btn-warning float-right">
                            Upload <span wire:loading wire:target="photos, upload" class="fas fa-spinner fa-spin"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
