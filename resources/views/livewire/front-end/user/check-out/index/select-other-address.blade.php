<div>
    <div class="row">
        <div class="col-lg-12">
            @forelse($data as $row)
                <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-12">
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
                            <div class="float-xs-none float-sm-none float-md-right">
                                <button type="button" class="btn btn-sm btn-warning" title="Select Address" onclick="select('{{$row->key_token}}')"><i class="fas fa-check"></i> SELECT</button>
                            </div>
                        </div>
                    </div>
                </blockquote>
            @empty
                <h4 class="text-muted">No Address Found</h4>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('remove_modal_select_other_address', param => {
        $('#modal-select_other_address').modal('hide');
        Swal.close();
    });

    function select(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Setting Address...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('select', key_token)
            }
        });
    }
</script>
@endpush