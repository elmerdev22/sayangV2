<div>
    @if($row)
        <dl class="row">
            <dt class="col-sm-3">Fullname</dt>
            <dd class="col-sm-9">{{ucwords($row->full_name)}}</dd>

            <dt class="col-sm-3">Contact number</dt>
            <dd class="col-sm-9">{{Utility::mobile_number_ph_format($row->contact_no)}}</dd>

            <dt class="col-sm-3">Address</dt>
            <dd class="col-sm-9">
                {{$row->address}} <br>
                {{$row->philippine_barangay->name}}, {{$row->philippine_barangay->philippine_city->name}}, <br>
                {{$row->philippine_barangay->philippine_city->philippine_province->name}}, 
                {{$row->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$row->zip_code}} <br>
            </dd>
        </dl>
    @else
        <h4 class="text-muted mb-3 mt-3">You don't have address yet.</h4>
    @endif
    <hr>
    <div class="">
        <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#modal-select_other_address"><i class="fas fa-pen"></i> Select Other Address</button>
        <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#modal-add_new_address"><i class="fas fa-plus"></i> Add New Address</button>
    </div>
</div>