<div>
     <table class="table text-center table-cell-nowrap table-sm">
        <thead>
            <tr>
                <th>Days</th>
                <th>Open Time</th>
                <th>Close Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->operating_hours as $row)
                <tr>
                    <td>{{$days[$row->day]}}</td>
                    <td>
                        {{$row->open_time ? date('h:i A', strtotime($row->open_time)) : 'Not set'}}
                    </td>
                    <td>
                        {{$row->close_time ? date('h:i A', strtotime($row->close_time)) : 'Not set'}}
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status{{$row->id}}" {{$row->status ? 'checked' : ''}} wire:change="status('{{$row->id}}')">
                            <label class="custom-control-label" for="status{{$row->id}}"></label>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-default" onclick="edit('{{$row->id}}','{{$days[$row->day]}}')">
                            <span class="fas fa-edit"></span>
                        </button>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
    <!-- Modal Operating Hours -->
    <div wire:ignore.self class="modal fade" id="modal-operating_hours" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$day_word}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Open Time</label>
                                    <input type="time" class="form-control" wire:model.lazy="open_time">
                                    @error('open_time') 
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Close Time</label>
                                    <input type="time" class="form-control" wire:model.lazy="close_time">
                                    @error('close_time') 
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">Save <span wire:loading wire:target="save" class="fas fa-spinner fa-spin"></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function edit(id , day){
        @this.set('day_word', day)
        @this.call('edit', id)
        $('#modal-operating_hours').modal('show');
    }
</script>    
@endpush