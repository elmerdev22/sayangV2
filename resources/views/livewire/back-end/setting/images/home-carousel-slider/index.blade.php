<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang">
                <div class="card-header">
                    <h5 class="card-title"> Home Carousel Slider Banner</h5> 
                    <div class="card-tools">
                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#add-image-banner"><span class="fas fa-plus"></span> Add Image</button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>                        
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover sayang-datatables text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Is Display</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $row)
                                            <tr>
                                                <td class="w-50">
                                                    <img class="img-fluid " src="{{UploadUtility::image_setting($row->id, 'home-bg-image')}}">
                                                </td>
                                                <td>            
                                                    <div class="icheck-warning">
                                                        <input type="checkbox" id="display-{{$row->id}}" wire:click="display('{{$row->id}}')" {{$row->is_display ? 'checked':''}}>
                                                        <label for="display-{{$row->id}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs" onclick="delete_swal('{{$row->id}}')">
                                                        <span class="fas fa-trash"></span> Delete
                                                    </button>
                                                </td>
                                            </tr> 
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    No Data Found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- NOTE: Always put the pagination after the .table-responsive class -->
                            @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="add-image-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="upload">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Home Carousel Slider Banner 
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if(!empty($photo))
                                <div class="col-12">
                                    <div class="card overflow-hidden sayang-photo-bordered">
                                        <div class="position-relative">
                                            <img src="{{ UploadUtility::livewire_tmp_url($photo) }}" class="img-fluid" alt="Product Photo">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <div wire:loading wire:target="upload" class="text-success">
                                    <span class="fas fa-spinner fa-spin"></span> Uploading Please Wait...
                                </div>
                                <div class="form-group">
                                    <label for="photo">Upload Photos</label> 
                                    <span wire:loading wire:target="photo" class="fas fa-spinner fa-spin"></span>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="photo" accept=".png, .jpeg, .jpg, .gif, .docx, .pdf" wire:model="photo">
                                        </div>
                                    </div>
                                    <div>
                                        <small>Recommended size: 960 x 350 pixels</small>
                                    </div>
                                    <div>
                                        <small>File Size: Maximum of 2MB</small>
                                    </div>
                                    <div>
                                        <small>File Extension: .png, .jpeg, .jpeg</small>
                                    </div>
                                    @if(empty($photo))
                                        @error('photo')
                                            <span class="invalid-feedback d-block">
                                                <span>{{$message}}</span>
                                            </span>
                                        @enderror
                                    @else
                                        @error('photo.*')
                                            <span class="invalid-feedback d-block">
                                                <span>{{$message}}</span>
                                            </span>
                                        @enderror
                                    @endif
                                    {{-- <div class="form-group mt-2">
                                        <button wire:target="photo, upload" wire:loading.attr="disabled" type="submit" class="btn btn-warning float-right">
                                            Upload <span wire:loading wire:target="photo, upload" class="fas fa-spinner fa-spin"></span>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="upload" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function delete_swal(id){
        Swal.fire({
            title: 'Are you sure do you want to delete this image ?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Deleting ...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('delete', id)
                    }
                });
            }
        })
    }

	function not_deletetable(name){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Cant`t delete because this '+name+' already have questions',
		})
    }
</script>   
@endpush