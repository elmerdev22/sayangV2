<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang">
                <div class="card-header">
                    <div class="card-title">
                        <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search Topic Name">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover sayang-datatables text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Topic name</th>
                                    <th scope="col">Arrangement</th>
                                    <th scope="col">Is Display</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                    <tr>
                                        <td>
                                            <img class="img-sm img-fluid img-circle " src="{{UploadUtility::help_centre_photos($row->id)}}">
                                        </td>
                                        <td>{{ucwords($row->topic)}}</td>
                                        <td>
                                            {{$row->arrangement}} <button class="btn btn-default btn-xs ml-1" onclick="edit_arrangement('{{$row->id}}','{{$row->arrangement}}')"><span class=" fas fa-edit"></span></button>
                                        </td>
                                        <td>            
                                            <div class="icheck-warning">
                                                <input type="checkbox" id="display-{{$row->id}}" wire:click="display('{{$row->id}}')" {{$row->is_display ? 'checked':''}}>
                                                <label for="display-{{$row->id}}">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('back-end.setting.help-centre-edit', ['id' => $row->id])}}" class="btn btn-default btn-xs">
                                                <span class="fas fa-edit"></span>
                                            </a>
                                            <button class="btn btn-danger btn-xs" onclick="@if($row->help_centre_question->count() > 0 ) not_deletetable('{{$row->name}}') @else delete_swal('{{$row->name}}', {{$row->id}}) @endif">
                                                <span class="fas fa-trash"></span>
                                            </button>
                                        </td>
                                    </tr> 
                                @empty
                                    <tr>
                                        <td colspan="5">
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
@push('scripts')
<script>
    function edit_arrangement(id, current_arrangement){
        (async () => {
                const { value: arrangement } = await Swal.fire({
                    title: 'Arrangement',
                    input: 'number',
                    inputLabel: 'arrangement',
                    inputValue: current_arrangement,
                    inputAttributes: {
                        min: 1,
                    },
                    validationMessage: 'Minimum arrangement is 1',
                    confirmButtonText: 'Save',  
                })

                if (arrangement) {
                    @this.call('update_arrangement', id , arrangement)
                }
        })()
    }
    function delete_swal(name, id){
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