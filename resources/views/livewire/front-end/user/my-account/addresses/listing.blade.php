<div>

    <div class="row">
        <div class="col-lg-12">
            @forelse($data as $row)
                <blockquote class="@if($row->is_default) quote-primary @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-12">
                            <div class="float-xs-none float-sm-none float-md-right">
                                <button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-sm btn-danger ml-1" title="Delete"><i class="fas fa-trash"></i></button>
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
                                <button type="button" class="btn btn-sm btn-default" @if($row->is_default) disabled @endif>Set as Default</button>
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
</script>
@endpush