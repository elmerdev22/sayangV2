<div>

    <div class="row">
        <div class="col-lg-12">
            @forelse($data as $row)
                <blockquote class="@if($row->is_default) quote-primary @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-12">
                            <div class="float-xs-none float-sm-none float-md-right">
                                <button type="button" class="btn btn-sm btn-primary" title="Edit" onclick="edit('{{$row->key_token}}')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-sm btn-danger ml-1" title="Delete" onclick="delete_data('{{$row->key_token}}')"><i class="fas fa-trash"></i></button>
                            </div>
                            <span class="fas fa-user"></span> <strong>{{ucwords($row->full_name)}} @if($row->is_default)<span class="badge badge-info">Default</span>@endif</strong>
                        </div>
                    </div>
                    <div>
                        <span class="fas fa-phone"></span> {{Utility::mobile_number_ph_format($row->contact_no)}}
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <span class="fas fa-map-marker"></span>
                            {{$row->address}} <br>
                            {{$row->philippine_barangay->name}}, {{$row->philippine_barangay->philippine_city->name}}, <br>
                            {{$row->philippine_barangay->philippine_city->philippine_province->name}}, 
                            {{$row->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$row->zip_code}} <br>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-right mt-2">
                                <button type="button" class="btn btn-sm btn-default" @if($row->is_default) disabled @else onclick="set_default('{{$row->key_token}}')" @endif>Set as Default</button>
                            </div>
                        </div>
                    </div>
                </blockquote>
            @empty
                <h4 class="text-muted">No Address Found</h4>
            @endforelse
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            {{$data->links()}}
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('addresses_initialize', param => {
        $('#modal-add_address').modal('hide');
    });

    function edit(key_token){

    }

    function delete_data(key_token){
        Swal.fire({
            title: 'Are you sure do you want to delete this address?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Deleting Address...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('delete', key_token)
                    }
                });
            }
        })
    }

    function set_default(key_token){
        Swal.fire({
            title: 'Are you sure do you want to set this as default address?',
            // text: "You won't be able to revert this!",
            // icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Address...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('set_default', key_token)
                    }
                });
            }
        })
    }

    function edit(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting Information...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('edit', key_token)
            }
        });
    }
</script>
@endpush