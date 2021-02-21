<div>
    <div class="row">
        <div class="col-md-12">
            
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background: url('{{ $cover_photo ? UploadUtility::livewire_tmp_url($cover_photo) : $old_cover_photo }}'); background-repeat: no-repeat; background-size: cover;">
                    <h3 class="widget-user-desc text-right">
                        @if ($cover_photo)
                            <button class="btn btn-warning btn-sm" wire:click="update_cover_photo">
                                <span class="fas fa-check"></span> Save
                                <span wire:loading wire:target="update_cover_photo" class="fas fa-spinner fa-spin"></span>
                            </button>
                            <button class="btn btn-danger btn-sm" wire:click="cancel_upload_cover">
                                <span class="fas fa-wrong"></span> Cancel
                                <span wire:loading wire:target="cancel_upload_cover" class="fas fa-spinner fa-spin"></span>
                            </button>
                        @endif  
                        <div class="form-control upload-btn-wrapper btn btn-default btn-sm" style="width: auto; height: 30px;">
                            <span class="fas fa-edit"></span> Cover Photo <span wire:loading wire:target="cover_photo" class="fas fa-spinner fa-spin"></span>
                            <input type="file" class="upload-btn form-control-file @error('cover_photo') is-invalid @enderror" wire:model="cover_photo" accept="image/*" />
                        </div>
                    </h3>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{$old_store_photo}}" alt="User Avatar" style="width: 90px; height: 90px;">
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-edit_store_photo">
                        <span class="fas fa-edit"></span>
                    </button>
                </div>
                <div class="card-footer bg-white">
                    <div class="row text-center">
                        <div class="col-12 pb-3">
                            <a target="_blank" href="{{route('front-end.profile.partner.index', ['slug' => $slug ])}}" class="btn btn-primary btn-sm">View Live Preview <span class="fa fa-eye"></span></a>
                        </div>
                        <div class="col-md-4 border pt-2">
                            <label>
                                <span class="fas fa-star"></span> 
                                <span class="text-muted">Ratings :</span>
                                <span class="text-warning">{{$ratings}}</span>
                                {{-- <small>(344 rating)</small> --}}
                            </label>
                        </div>
                        <div class="col-md-4 border pt-2">
                            <label>
                                <span class="fas fa-store"></span>
                                <span class="text-muted">Products :</span>
                                <span class="text-warning">{{number_format($products, 0)}}</span> 
                            </label>
                        </div>
                        <div class="col-md-4 border pt-2">
                            <label>
                                <span class="fas fa-users"></span>
                                <span class="text-muted">Followers :</span>
                                <span class="text-warning">{{number_format($followers, 0)}}</span> 
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Store Photo Edit-->
    <div wire:ignore.self id="modal-edit_store_photo" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload New Store Photo</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="POST" wire:submit.prevent="update_store_photo">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="text-center overflow-hidden">
                                    <img class="mb-2 mt-1 sayang-img-upload-preview" src="{{ $store_photo ? UploadUtility::livewire_tmp_url($store_photo) : asset('images/default-photo/image.png')}}" alt="Photo">
                                </div>
                                <div class="form-group">
                                    <label for="store_photo">Store Photo* 
                                        <span wire:loading wire:target="store_photo" class="fas fa-spinner fa-spin"></span>
                                    </label>
                                    <input type="file" id="store_photo" class="form-control-file @error('store_photo') is-invalid @enderror" accept=".jpg, .jpeg, .png" wire:model="store_photo">
                                    <div>
                                        <small>File Size: Maximum of 2MB</small>
                                    </div>
                                    <div>
                                        <small>File Extension: .png, .jpeg, .jpeg</small>
                                    </div>
                                    @error('store_photo')
                                        <span class="invalid-feedback">
                                            <span>{{$message}}</span>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <button wire:target="store_photo" wire:loading.attr="disabled" type="submit" class="btn btn-warning float-right">
                                        Save <span wire:loading wire:target="update_store_photo" class="fas fa-spinner fa-spin"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @error('cover_photo')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{$message}}',
        })
    </script> 
    @enderror
</div>

@push('scripts')
<script>
    window.livewire.on('close_modal', param => {
        $('#'+param['modal']+'').modal('hide');
    });
</script>   
@endpush