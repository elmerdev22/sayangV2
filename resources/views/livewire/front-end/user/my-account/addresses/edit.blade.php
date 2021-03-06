<div>
    <form method="POST" wire:submit.prevent="update" id="form-edit_address">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="full_name" class="form-control text-capitalize @error('full_name') is-invalid @enderror" name="full_name" wire:model.lazy="full_name" placeholder="Full Name">
                    @error('full_name') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="contact_no" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" wire:model.lazy="contact_no" placeholder="Contact No.">
                    @error('contact_no') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select id="region" class="form-control @error('region') is-invalid @enderror" name="region" wire:model="region">
                        <option value="">Region</option>
                        @foreach($component->philippine_regions() as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    @error('region') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select id="province" class="form-control @error('province') is-invalid @enderror" name="province" wire:model="province">
                        <option value="">Province</option>
                        @foreach($component->philippine_provinces($region) as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    @error('province') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select id="city" class="form-control @error('city') is-invalid @enderror" name="city" wire:model="city">
                        <option value="">City/Municipality</option>
                        @foreach($component->philippine_cities($province) as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    @error('city') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select id="barangay" class="form-control @error('barangay') is-invalid @enderror" name="barangay" wire:model="barangay">
                        <option value="">Barangay</option>
                        @foreach($component->philippine_barangays($city) as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    @error('barangay') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="zip_code" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" wire:model.lazy="zip_code" placeholder="Zip Code">
                    @error('zip_code') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" wire:model.lazy="address" placeholder="Bldg., Street., Subdv., and Etc.">
                    @error('address') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('edit_address', param => {
        @this.call('initialize', param['key_token'])
        $('#modal-edit_address').modal('show');
        Swal.close();
    });
    window.livewire.on('addresses_initialize', param => {
        $('#modal-edit_address').modal('hide');
        Swal.close();
    });
    
</script>
@endpush