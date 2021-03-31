<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Web Notifications</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Notification name</th>
                                <th scope="col">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td>{{$row->settings_name}}</td>
                                <td>{{$row->title}}</td>
                                <td>{!! $row->message !!}</td>
                                <td>
                                    <button class="btn btn-default btn-sm" onclick="edit_web_notification('{{$row->id}}')">
                                        <span class=" fas fa-edit"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- NOTE: Always put the pagination after the .table-responsive class -->
                @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="edit-web-notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{$notification_name}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Input here..." wire:model.lazy="title">
                            @error('title')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" wire:model.lazy="message"></textarea>
                            @error('message')
                                <span class="invalid-feedback" style="display: block;">
                                    <span>{{$message}}</span>
                                </span> 
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="save" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function edit_web_notification(id){
        @this.call('edit', id)
        $('#edit-web-notification').modal('show');
    }
</script>    
@endpush