<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Terms and Conditions (Partners)</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="save_for_partners">
                        <div class="form-group">
                            <div class="form-group">
                                <div wire:ignore>
                                    <textarea id="summernote_partners" class="form-control" wire:model.lazy="for_partners">{{$for_partners}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-warning float-right">Save <span wire:loading wire:target="save_for_partners" class="fas fa-spinner fa-spin"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Terms and Conditions (Users)</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="save_for_users">
                        <div class="form-group">
                            <div class="form-group">
                                <div wire:ignore>
                                    <textarea id="summernote_users" class="form-control" wire:model.lazy="for_users">{{$for_users}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-warning float-right">Save <span wire:loading wire:target="save_for_users" class="fas fa-spinner fa-spin"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $('#summernote_partners').summernote({
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('for_partners', contents)
            }
        },
        height: 300, 
        placeholder: 'Terms and Condition for Partners here...'
    });
    $('#summernote_users').summernote({
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('for_users', contents)
            }
        },
        height: 300, 
        placeholder: 'Terms and Condition for Users here...'
    });
</script>    
@endpush