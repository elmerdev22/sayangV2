<div>
    <div class="row">
	    <div class="col-12">
	        <div class="card card-outline card-sayang">
	            <div class="card-header">
	                <h3 class="card-title">Add Category</h3>
				</div>
				
	              <!-- /.card-header -->
	              <!-- form start -->
	            <form role="form" wire:submit.prevent="add">
	                <div class="card-body">
						<div class="form-group">
							<label for="photo">Photo* <small class="text-muted"><i>png, jpg, jpeg. </i></small></label>
							<div class="text-center overflow-hidden">
								<img class="mb-2 mt-1 imagePreview" src="{{ $photo ? UploadUtility::livewire_tmp_url($photo) : asset('images/default-photo/image.png')}}" alt="">

								<div class="form-control upload-btn-wrapper btn btn-default">
									<i class="fas fa-upload"></i> Upload Photo <span wire:loading wire:target="photo" class="fas fa-spinner fa-spin"></span>
									<input type="file" class="upload-btn" wire:model="photo" accept="image/*" />
								</div>
							</div>
							@error('photo')
				                <span class="invalid-feedback" style="display: block;">
				                    <span>{{$message}}</span>
				                </span> 
				            @enderror
						</div>
	                    <div class="form-group">
	                        <label for="name">Name</label>
	                        <input type="text" class="form-control  @error('name') is-invalid @enderror" wire:model.lazy="name"  placeholder="Enter Name">
				            @error('name')
				                <span class="invalid-feedback" style="display: block;">
				                    <span>{{$message}}</span>
				                </span> 
				            @enderror
						</div>
						<div class="form-group">
							<div class="icheck-warning">
								<input type="checkbox" id="display" wire:model="is_display" {{$is_display ? 'checked' : ''}}>
								<label for="display">
									Display in Home Carousel
								</label>
							</div>
						</div>
	                </div>
	            	<!-- /.card-body -->

	                <div class="card-footer">
	                    <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="add" class="fas fa-spinner fa-spin"></span></button>
	                </div>
				</form>
				
	        </div>
	    </div>
	</div>
</div>