<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Bids Settings</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($data as $row)
                    <div class="col-md-6">
                        <label>{{$row->settings_name}}</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control text-center" min="1" max="100" disabled value="{{$row->settings_value}}">
                            <div class="input-group-append bg-warning">
                            <button class="btn btn-default" onclick="edit('{{$row->id}}')"><span class="fas fa-edit"></span></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="edit-settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{$settings_name}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Settings Value</label>
                            <input type="number" class="form-control text-center" min="1" wire:model.lazy="settings_value">
                            @error('settings_value')
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
    function edit(settings_id){
        @this.call('edit', settings_id)
        $('#edit-settings').modal('show');
    }
</script>    
@endpush