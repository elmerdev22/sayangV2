<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Header & Footer</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form role="form" wire:submit.prevent="update('logo')">
                        <div class="form-group">
                            <label for="logo">Logo* <small class="text-muted"><i>png, jpg, jpeg. </i></small></label>
                            <div class="text-center overflow-hidden">
                                
                                @if ($logo)
                                    <img class="mb-2 mt-1 img-thumbnail" src="{{ UploadUtility::livewire_tmp_url($logo)}}" alt="">
                                @else
                                    <img class="mb-2 mt-1 img-thumbnail" src="{{$current_logo}}" alt="">
                                @endif

								<div class="form-control upload-btn-wrapper btn btn-default">
									<i class="fas fa-upload"></i> Upload logo <span wire:loading wire:target="logo" class="fas fa-spinner fa-spin"></span>
									<input type="file" class="upload-btn" wire:model="logo" accept="image/*" />
								</div>
                            </div>
                            @error('logo')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            @if ($logo)
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-danger w-100" wire:click="cancel('logo')">Cancel <span wire:loading wire:target="cancel" class="fas fa-spinner fa-spin"></span></button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-warning w-100">Save <span wire:loading wire:target="update" class="fas fa-spinner fa-spin"></span></button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <form role="form" wire:submit.prevent="update('icon')">
                        <div class="form-group">
                            <label for="icon">Icon* <small class="text-muted"><i>Note: .ico, .icon only(to become transparent). </i></small></label>
                            <div class="text-center overflow-hidden">
                                
                                @if ($icon)
                                    <img class="mb-2 mt-1 img-thumbnail" src="{{ UploadUtility::livewire_tmp_url($icon)}}" alt="">
                                @else
                                    <img class="mb-2 mt-1 img-thumbnail" src="{{$current_icon}}" alt="">
                                @endif

								<div class="form-control upload-btn-wrapper btn btn-default">
									<i class="fas fa-upload"></i> Upload Icon <span wire:loading wire:target="icon" class="fas fa-spinner fa-spin"></span>
									<input type="file" class="upload-btn" wire:model="icon" accept="image/*" />
								</div>
                            </div>
                            @error('icon')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            @if ($icon)
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-danger w-100" wire:click="cancel('icon')">Cancel <span wire:loading wire:target="cancel" class="fas fa-spinner fa-spin"></span></button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-warning w-100">Save <span wire:loading wire:target="update" class="fas fa-spinner fa-spin"></span></button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>