<div>
    <form method="POST" wire:submit.prevent="update">
        <div class="modal-body">

            <div class="row">
                <div class="col-lg-12 px-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="first_name">First Name*</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" wire:model.lazy="first_name" placeholder="First Name">
                                @error('first_name')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="last_name">Last Name*</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" wire:model.lazy="last_name" placeholder="Last Name">
                                @error('last_name')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="designation">Designation*</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" wire:model.lazy="designation" placeholder="Designation">
                                @error('designation')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="representative_email">Email*</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="representative_email" wire:model.lazy="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="representative_contact_no">Contact No*</label>
                                <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="representative_contact_no" wire:model.lazy="contact_no" placeholder="Contact No.">
                                @error('contact_no')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:loading.attr="disabled" wire:target="update" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning" wire:loading.attr="disabled" wire:target="update">
                Save Changes <span class="fas fa-spin fa-spinner" wire:loading wire:target="update"></span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('initialize_representative_information', param => {
        $('#modal-edit_representative_information').modal('hide');
        $('#modal-upload_representative_id').modal('hide');
    });
</script>
@endpush