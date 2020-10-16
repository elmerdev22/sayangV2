<div>
    <div class="row">
        <div class="col-sm-6"><h4>Representative Details</h4></div>
        <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="representative-details-form" wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row">
                    <div class="col-lg-6">
                        <label for="first_name">First Name*</label>
                        <input type="text" class="form-control text-capitalize" id="first_name" wire:model.lazy="first_name" placeholder="Enter Firstname">
                    </div>
                    <div class="col-lg-6">
                        <label for="last_name">Last Name*</label>
                        <input type="text" class="form-control text-capitalize" id="last_name" wire:model.lazy="last_name" placeholder="Enter Lastname">
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="designation">Designation*</label>
                    <input type="text" class="form-control" id="designation" wire:model.lazy="designation" placeholder="Enter Designation">
                </div>

                <div class="form-group">
                    <label for="representative_email">Email Address*</label>
                    <input type="text" class="form-control" id="representative_email" wire:model.lazy="representative_email" placeholder="Enter Email Address">
                </div>

                <div class="form-group">
                    <label for="representative_contact_no">Contact Number*</label>
                    <input type="text" class="form-control" id="representative_contact_no" wire:model.lazy="representative_contact_no" placeholder="Enter Contact">
                </div>

                <div class="form-group">
                    <label for="representative_id">Upload ID Here*</label>
                    <div class="input-group" id="input-group-representative_id">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="representative_id" accept=".png, .jpeg, .jpg, .gif, .docx, .pdf" wire:model="representative_id">
                            <label class="custom-file-label" for="representative_id">
                                @if($representative_id) 
                                    File Selected <i class="fas fa-check text-success"></i> 
                                @else 
                                    Choose File 
                                @endif
                                <span wire:loading wire:target="representative_id" class="fas fa-spinner fa-spin"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-warning bs-stepper-previous" wire:target="representative_id" wire:loading.attr="disabled"><span class="fas fa-chevron-left"></span> Previous</button>
                <button type="submit" class="btn btn-warning text-white float-right" wire:target="representative_id" wire:loading.attr="disabled">Next <span class="fas fa-chevron-right"></span></button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('representative_details_input_errors', param => {
        $('.representative-details-form .form-control').each(function () {
            $(this).removeClass('is-invalid');
        });
        $('.representative-details-form .invalid-feedback').each(function () {
            $(this).remove();
        });

        for(var key in param){
            $('#'+key).addClass('is-invalid');
            if(key == 'representative_id'){
                $('#input-group-'+key).after(`<span class="invalid-feedback" style="display: block;"><span>`+param[key][0]+`</span></span>`);
            }else{
                $('#'+key).after(`<span class="invalid-feedback"><span>`+param[key][0]+`</span></span>`);
            }
        }
    });

    window.livewire.on('representative_details_success', param => {
        stepper1.next();
    });
</script>
@endpush
