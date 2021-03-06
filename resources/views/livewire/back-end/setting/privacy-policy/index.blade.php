<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Privacy Policy</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <div class="form-group">
                                <div wire:ignore>
                                    <textarea id="summernote" class="form-control" wire:model.lazy="privacy_policy">{{$privacy_policy}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-warning float-right">Save <span wire:loading wire:target="save" class="fas fa-spinner fa-spin"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#summernote').summernote({
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('privacy_policy', contents)
            }
        },
        height: 300, 
        placeholder: 'Privacy policy content here...'
    });
</script>    
@endpush