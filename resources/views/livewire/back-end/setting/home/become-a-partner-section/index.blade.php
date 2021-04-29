<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Beacome A Partner</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="photo">Background Photo* <small class="text-muted"><i>png, jpg, jpeg. </i></small></label>
                            <div class="text-center overflow-hidden">
                                
                                @if ($photo)
                                    <img class="mb-2 mt-1 img-fluid img-responsive" src="{{UploadUtility::livewire_tmp_url($photo) }}" alt="">
                                @else
                                    <img class="mb-2 mt-1 img-fluid img-responsive" src="{{$photo_url}}" alt="">
                                @endif

                                <div class="form-control upload-btn-wrapper btn btn-default">
                                    <i class="fas fa-upload"></i> Upload Photo <span wire:loading wire:target="photo" class="fas fa-spinner fa-spin"></span>
                                    <input type="file" class="upload-btn" wire:model="photo" accept="image/*"/>
                                </div>
                            </div>
                            @error('photo')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Header</label>
                            <textarea class="form-control" wire:model.lazy="header"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subheader</label>
                            <textarea class="form-control" wire:model.lazy="sub_header"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Save <span wire:loading wire:target="save" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>