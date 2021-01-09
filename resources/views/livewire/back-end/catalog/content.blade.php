<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang">
                <div class="card-header">
                    <div class="card-title">
                        <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search ...">
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @forelse($data as $category)
                        <div class="col-12">
                            <div class="card card-light collapsed-card" wire:ignore.self>
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <img class="img-sm img-fluid img-circle mr-3" src="{{UploadUtility::category_photo($category->key_token)}}">
                                        <span style="line-height: 1.5">
                                            {{ucwords($category->name)}}
                                        </span>
                                    </h3>

                                    <div class="card-tools">
                                        <button class="btn btn-tool" @if(!Utility::is_category_deletable($category->id)) onclick="not_deletetable('category')" @else onclick="delete_swal('{{$category->key_token}}', 'category')" @endif >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{route('back-end.catalog.edit', ['key_token' => $category->key_token])}}" class="btn btn-tool" ><i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form wire:submit.prevent="add({{$category->id}})">
                                                <label>Add Subcategory</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name" placeholder="Subcategory Name">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-warning">
                                                            <span class="fas fa-plus"></span>
                                                        </button>
                                                    </div>

                                                    @error('name') 
                                                        <span class="invalid-feedback" style="display: block;">
                                                            <span>{{$message}}</span>
                                                        </span> 
                                                    @enderror
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        @forelse($category->sub_categories as $sub_category)
                                            <div class="col-lg-4 col-md-6">
                                                <button class="btn btn-danger btn-xs"  @if(!Utility::is_subcategory_deletable($sub_category->id)) onclick="not_deletetable('subcategory')" @else onclick="delete_swal('{{$sub_category->key_token}}','subcategory')" @endif >        
                                                    <span class="fas fa-trash"></span>
                                                </button>
                                                <span class="fas fa-chevron-right"></span> 
                                                {{ucwords($sub_category->name)}}
                                            </div>
                                        @empty
                                            <div class="col-lg-4 col-md-6">
                                                <span class="fas fa-chevron-right"></span> 
                                                No Subcategory!
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <h5 class=" bg-warning py-2 text-center">No Found Data!</h5>
                        </div>
                        @endforelse
                    </div>
                    <!-- NOTE: Always put the pagination after the .table-responsive class -->
                    @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    
    function delete_swal(key, name){
        Swal.fire({
            title: 'Are you sure do you want to delete this '+name+'?',
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
                    html              : 'Deleting '+name+'...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('delete', key, name)
                    }
                });
            }
        })
    }

	function not_deletetable(name){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Cant`t delete because this '+name+' already have transactions',
		})
    }
</script>   
@endpush