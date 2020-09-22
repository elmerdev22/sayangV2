<div>
    <div class="row">
        <div class="col-sm-6"><h4>Bank Details</h4></div>
        <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="bank-details-form" wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="bank">Bank*</label>
                            <select class="form-control" id="bank" wire:model="bank">
                                <option value="">Select</option>
                                @foreach($banks as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="account_name">Account Name*</label>
                            <input type="text" class="form-control text-capitalize" id="account_name" wire:model.lazy="account_name" placeholder="Enter Account Name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="account_number">Account Number*</label>
                    <input type="text" class="form-control" id="account_number" wire:model.lazy="account_number" placeholder="Enter Account Number">
                </div>

                <button type="button" class="btn btn-warning bs-stepper-previous"><span class="fas fa-chevron-left"></span> Previous</button>
                <button type="submit" class="btn btn-warning text-white float-right">Next <span class="fas fa-chevron-right"></span></button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('bank_details_input_errors', param => {
        $('.bank-details-form .form-control').each(function () {
            $(this).removeClass('is-invalid');
        });
        $('.bank-details-form .invalid-feedback').each(function () {
            $(this).remove();
        });

        for(var key in param){
            $('#'+key).addClass('is-invalid');
            $('#'+key).after(`<span class="invalid-feedback"><span>`+param[key][0]+`</span></span>`);
        }
    });

    window.livewire.on('bank_details_success', param => {
        stepper1.next();
    });
</script>
@endpush