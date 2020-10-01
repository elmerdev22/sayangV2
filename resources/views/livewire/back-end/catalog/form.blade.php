<div>
    <div class="row">
	    <div class="col-12">
	        <div class="card card-warning">
	            <div class="card-header">
	                <h3 class="card-title">Category Name</h3>
	            </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	            <form role="form" wire:submit.prevent="add">
	                <div class="card-body">
	                    <div class="form-group">
	                        <label for="name">Name</label>
	                        <input type="text" class="form-control  @error('name') is-invalid @enderror" wire:model.lazy="name"  placeholder="Enter Name">
				            @error('name') 
				                <span class="invalid-feedback" style="display: block;">
				                    <span>{{$message}}</span>
				                </span> 
				            @enderror
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