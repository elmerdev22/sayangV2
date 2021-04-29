<div>
    <div class="row py-4">
        <p><span class="fas fa-hand-point-right"></span> First things first. Before you can start selling, we would need to know more details about you and your business.</p>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h4>Business Details</h4>
        </div>
        <div class="col-sm-6">
            <p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="business-details-form" wire:submit.prevent="update">
                <div class="form-group">
                    <label for="business_name">Business name*</label>
                    <input type="text" class="form-control" id="business_name" wire:model.lazy="business_name" placeholder="Enter Business name">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="region">Region*</label>
                            <select class="form-control" id="region" wire:model="region">
                                <option value="">Select</option>
                                @foreach($regions as $row)
                                    <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="province">Province*</label>
                            <select class="form-control" id="province" wire:model="province">
                                <option value="">Select</option>
                                @foreach($provinces as $row)
                                    <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="city">City* </label>
                            <select class="form-control" id="city" wire:model="city">
                                <option value="">Select</option>
                                @foreach($cities as $row)
                                    <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="barangay">Barangay* </label>
                            <select class="form-control" id="barangay" wire:model="barangay">
                                <option value="">Select</option>
                                @foreach($barangays as $row)
                                    <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="business_address">Address*</label>
                            <input type="text" class="form-control" id="business_address" wire:model.lazy="business_address" placeholder="Bldg., Street, Subdivision">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="map_address_link">Google Maps address link*</label>
                    <input type="text" class="form-control" id="map_address_link" wire:model.lazy="map_address_link" placeholder="Enter Google Maps address link">
                </div>

                <div class="form-group">
                    <label for="business_contact_no">Business Contact Number*</label>
                    <input type="text" class="form-control" id="business_contact_no" wire:model.lazy="business_contact_no" placeholder="Enter Business Contact Number">
                </div>

                <div class="form-group">
                    <label for="business_email">Business Email Address*</label>
                    <input type="text" class="form-control" id="business_email" wire:model.lazy="business_email" placeholder="Enter Business Email Address">
                </div>

                <div class="form-group">
                    <label for="dti_registration_no">DTI Registration Number*</label>
                    <input type="text" class="form-control" id="dti_registration_no" wire:model.lazy="dti_registration_no" placeholder="Enter DTI Registration Number">
                </div>

                <div class="form-group">
                    <label for="tin">TIN*</label>
                    <input type="text" class="form-control" id="tin" wire:model.lazy="tin" placeholder="Enter TIN">
                </div>
                <div class="form-group">
                    <label for="dti_certificate_file">Upload DTI Certificate Here*</label>
                    <div class="input-group" id="input-group-dti_certificate_file">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="dti_certificate_file" accept=".png, .jpeg, .jpg, .gif, .docx, .pdf" wire:model="dti_certificate_file">
                            <label class="custom-file-label" for="dti_certificate_file">
                                @if($dti_certificate_file) 
                                    File Selected <i class="fas fa-check text-success"></i> 
                                @else 
                                    Choose File 
                                @endif
                                <span wire:loading wire:target="dti_certificate_file" class="fas fa-spinner fa-spin"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-white float-right" wire:target="dti_certificate_file" wire:loading.attr="disabled">Next <span class="fas fa-chevron-right"></span></button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('business_details_input_errors', param => {
        $('.business-details-form .form-control').each(function () {
            $(this).removeClass('is-invalid');
        });
        $('.business-details-form .invalid-feedback').each(function () {
            $(this).remove();
        });

        for(var key in param){
            $('#'+key).addClass('is-invalid');
            if(key == 'dti_certificate_file'){
                $('#input-group-'+key).after(`<span class="invalid-feedback" style="display: block;"><span>`+param[key][0]+`</span></span>`);
            }else{
                $('#'+key).after(`<span class="invalid-feedback"><span>`+param[key][0]+`</span></span>`);
            }
        }
    });

    window.livewire.on('business_details_success', param => {
        stepper1.next();
    });
</script>
@endpush