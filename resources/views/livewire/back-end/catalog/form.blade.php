<div>
    <div class="row">
	    <div class="col-12">
	        <div class="card card-outline card-sayang">
	            <div class="card-header">
	                <h3 class="card-title">Category Name</h3>
	            </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	            <form role="form" wire:submit.prevent="add">
	                <div class="card-body">
						<div class="form-group">
							<label for="photo">Photo* <small class="text-muted"><i>png, jpg, jpeg. </i></small></label>
							<div class="card" style="height: 200px; width: 200px;  margin: 0 auto; float: none; margin-bottom: 10px;">
								
							</div>
							<input type="file" id="photo" name="photo" class="form-control" accept="image/*">
							
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
								<input type="checkbox" id="display">
								<label for="display">
									Display in Home Carousel
								</label>
							</div>
						</div>
	                </div>
	            	<!-- /.card-body -->

	                <div class="card-footer">
	                    <button type="submit" class="btn btn-warning">Submit <span wire:loading="add" class="fas fa-spinner fa-spin"></span></button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
@push('scripts')

@endpush