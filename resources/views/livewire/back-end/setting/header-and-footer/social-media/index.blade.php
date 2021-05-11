<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Social Media</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 text-right">
                    <button class="btn btn-primary" onclick="action('add')">Add</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                    <tr>
                                        <td>{{ucfirst($row->name)}}</td>
                                        <td>{{$row->icon}} (<li class="{{$row->icon}}"></li>)</td>
                                        <td>{{$row->url}}</td>
                                        <td>
                                            <div class="icheck-warning">
                                                <input type="checkbox" id="display-{{$row->id}}" wire:click="display('{{$row->id}}')" {{$row->status ? 'checked':''}}>
                                                <label for="display-{{$row->id}}">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-default btn-sm btn-flat" onclick="action('edit', '{{$row->id}}')">
                                                <span class="fas fa-edit"></span>
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-flat" onclick="delete_swal('{{$row->id}}')">
                                                <span class="fas fa-trash"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No data Added.</td>
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
    
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal-social_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ucfirst($action)}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Social Media Name</label>
                            <input type="text" class="form-control" placeholder="Ex. facebook, twitter, instagram, etc..." wire:model.lazy="name">
                            @error('name')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" placeholder="Ex. fab fa-facebook-square, etc..." wire:model.lazy="icon">
                            @error('icon')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <textarea class="form-control" placeholder="https://" wire:model.lazy="url"></textarea>
                            @error('url')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Save <span wire:loading wire:target="save" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.livewire.on('alert', param => {
        $('#modal-social_media').modal('hide');
    });

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

    function action(type, id = null){
        @this.call('reset_data')
        @this.set('action', type)
        if(type == 'edit'){
            @this.call('edit', id)
        }
        $('#modal-social_media').modal('show');
    }
</script>
@endpush