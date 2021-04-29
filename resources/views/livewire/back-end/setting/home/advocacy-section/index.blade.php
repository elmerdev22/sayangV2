<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Advocacy Section </h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save_text_data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Header</label>
                            <textarea class="form-control" wire:model.lazy="header"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subheader</label>
                            <textarea class="form-control" wire:model.lazy="sub_header"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Save <span wire:loading wire:target="save_text_data" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-12">
                    <label>Cards</label>
                </div>
            </div>
            <div class="row">
                @foreach ($card_data as $row)
                    <div class="col-md-4 py-3">
                        <div class="card">
                            <img src="{{UploadUtility::image_setting($row->id, 'advocacy-section')}}" class="card-img opacity" style="height: 230px; width: auto; object-fit: cover;">
                            <div class="card-img-overlay text-white">
                                <h5 class="card-title">{{$row->settings_name}}</h5>
                                <p class="card-text">{{$row->description}}</p>
                                <a href="{{$row->redirect}}" class="btn btn-light">Discover</a>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block" onclick="edit_card('{{$row->id}}')"><span class="fas fa-edit"></span> Edit</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Edit Advocacy section Modal -->
    <div wire:ignore.self class="modal fade" id="modal-advocacy_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save_card">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="photo">Photo* <small class="text-muted"><i>png, jpg, jpeg. </i></small></label>
                                    <div class="text-center overflow-hidden">
                                        
                                        @if ($photo)
                                            <img class="mb-2 mt-1 imagePreview" src="{{UploadUtility::livewire_tmp_url($photo) }}" alt="">
                                        @else
                                            <img class="mb-2 mt-1 imagePreview" src="{{$selected_id ? UploadUtility::image_setting($selected_id, 'advocacy-section') : ''}}" alt="">
                                        @endif

                                        <div class="form-control upload-btn-wrapper btn btn-default">
                                            <i class="fas fa-upload"></i> Upload Photo <span wire:loading wire:target="photo" class="fas fa-spinner fa-spin"></span>
                                            <input type="file" class="upload-btn" wire:model="photo" accept="image/*"/>
                                        </div>
                                    </div>
                                    @error('photo')
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" wire:model.lazy="title">
                                    @error('title')
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" wire:model.lazy="description"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" style="display: block;">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Button Link (redirect)</label>
                                    <textarea class="form-control" wire:model.lazy="redirect"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="save_card" class="fas fa-spinner fa-spin"></span></button>
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
    function edit_card(id){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting Information...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('edit_card', id)
            }
        });
    }
    
    window.livewire.on('show_modal', param => {
        $('#modal-advocacy_section').modal('show');
        Swal.close();
    });
</script>    
@endpush