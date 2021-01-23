<div>
    @if($row)
        <div class="mb-4">
            <div class="row">
                <div class="col-12">
                    <span class="fas fa-user"></span> <strong>{{ucwords($row->full_name)}}</strong>
                </div>
            </div>
            <div>
                <span class="fas fa-phone"></span> {{Utility::mobile_number_ph_format($row->contact_no)}}
            </div>
            <div class="row">
                <div class="col-12">
                    <span class="fas fa-map-marker"></span>
                    {{$row->address}} <br>
                    {{$row->philippine_barangay->name}}, {{$row->philippine_barangay->philippine_city->name}}, <br>
                    {{$row->philippine_barangay->philippine_city->philippine_province->name}}, 
                    {{$row->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$row->zip_code}} <br>
                </div>
            </div>        
        </div>
    @else
        <h4 class="text-muted mb-3 mt-3">You don't have address yet.</h4>
    @endif
    
    <div class="mb-3">
        <button type="button" class="btn btn-warning btn-sm my-1" data-toggle="modal" data-target="#modal-select_other_address"><i class="fas fa-pen"></i> Select Other Address</button>
        <button type="button" class="btn btn-warning btn-sm my-1" data-toggle="modal" data-target="#modal-add_new_address"><i class="fas fa-plus"></i> Add New Address</button>
    </div>
</div>