<div>
    <form method="POST" wire:submit.prevent="update">

        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 px-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="business_name">Business name*</label>
                                <input type="text" class="form-control @error('business_name') is-invalid @enderror" id="business_name" wire:model.lazy="business_name" placeholder="Enter Business name">
                                @error('business_name')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="region">Region*</label>
                                        <select class="form-control @error('region') is-invalid @enderror" id="region" wire:model="region">
                                            <option value="">Select</option>
                                            @foreach($regions as $row)
                                                <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                            <span class="invalid-feedback">
                                                <span>{{$message}}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="province">Province*</label>
                                        <select class="form-control @error('province') is-invalid @enderror" id="province" wire:model="province">
                                            <option value="">Select</option>
                                            @foreach($provinces as $row)
                                                <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                            <span class="invalid-feedback">
                                                <span>{{$message}}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city">City* </label>
                                        <select class="form-control @error('city') is-invalid @enderror" id="city" wire:model="city">
                                            <option value="">Select</option>
                                            @foreach($cities as $row)
                                                <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <span class="invalid-feedback">
                                                <span>{{$message}}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="barangay">Barangay* </label>
                                        <select class="form-control @error('barangay') is-invalid @enderror" id="barangay" wire:model="barangay">
                                            <option value="">Select</option>
                                            @foreach($barangays as $row)
                                                <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                            @endforeach
                                        </select>
                                        @error('barangay')
                                            <span class="invalid-feedback">
                                                <span>{{$message}}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Address*</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" wire:model.lazy="address" placeholder="Bldg., Street, Subdivision">
                                @error('address')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="map_address_link">Map Address Link*</label>
                                <input type="text" class="form-control @error('map_address_link') is-invalid @enderror" id="map_address_link" wire:model.lazy="map_address_link" placeholder="Paste Map Address Link">
                                @error('map_address_link')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="contact_no">Business Contact No.*</label>
                                <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" wire:model.lazy="contact_no" placeholder="Business Contact Number">
                                @error('contact_no')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Business Email*</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.lazy="email" placeholder="Business Email">
                                @error('email')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dti_registration_no">DTI Registration No.*</label>
                                <input type="text" class="form-control @error('dti_registration_no') is-invalid @enderror" id="dti_registration_no" wire:model.lazy="dti_registration_no" placeholder="DTI Registration No.">
                                @error('dti_registration_no')
                                    <span class="invalid-feedback">
                                        <span>{{$message}}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tin">TIN*</label>
                                <input type="text" class="form-control @error('tin') is-invalid @enderror" id="tin" wire:model.lazy="tin" placeholder="TIN">
                                @error('tin')
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
    window.livewire.on('initialize_business_information', param => {
        $('#modal-edit_business_information').modal('hide');
    });
</script>
@endpush