<div>
    <div class="row">
        <div class="col-lg-12">
            @forelse($data as $row)
                <div class="row border-bottom p-3">
                    <div class="col-sm-8">

                        <dl class="row">
                            <dd class="col-sm-12">{{ucwords($row->full_name)}} @if($row->is_default)<span class="badge badge-info">Default</span>@endif</dd>
        
                            <dd class="col-sm-12">{{Utility::mobile_number_ph_format($row->contact_no)}}</dd>
        
                            <dd class="col-sm-12">
                                {{$row->address}} <br>
                                {{$row->philippine_barangay->name}}, {{$row->philippine_barangay->philippine_city->name}}, <br>
                                {{$row->philippine_barangay->philippine_city->philippine_province->name}}, 
                                {{$row->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$row->zip_code}} <br>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-sm-4">
                        <div class="float-xs-none float-sm-none float-md-right">
                            <button type="button" class="btn btn-primary btn-sm" title="Select Address" onclick="select('{{$row->key_token}}')"><i class="fas fa-check"></i> SELECT</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">No Address Found</p>
            @endforelse
        </div>
        <div class="col-12 pt-3">
            <button type="button" class="btn btn-light float-right" data-dismiss="modal"><span class="fas fa-times"></span> Close</button>
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