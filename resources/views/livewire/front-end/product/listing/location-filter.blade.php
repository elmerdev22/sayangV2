<article class="filter-group">
    <header class="card-header">
        <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
            <i class="icon-control fa fa-chevron-down"></i>
            <h6 class="title">Location</h6>
        </a>
    </header>
    <div wire:ignore.self class="filter-content collapse {{$collapse == 'show' ? 'show' : ''}}" id="collapse_3" style="">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12">
                    <h6 class="card-title">Regions</h6>
                    <select class="form-control" id="region" wire:model="region">
                        <option value="">Select</option>
                        @foreach($regions as $row)
                            <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <h6 class="card-title">Provinces <small><span wire:loading wire:target="region" class="fas fa-spin fa-spinner"></span></small></h6>
                    <select class="form-control" id="province" wire:model="province">
                        <option value="">Select</option>
                        @foreach($provinces as $row)
                            <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <h6 class="card-title">City <small><span wire:loading wire:target="province" class="fas fa-spin fa-spinner"></span></small></h6>
                    <select class="form-control" id="city" wire:model="city">
                        <option value="">Select</option>
                        @foreach($cities as $row)
                            <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</article> <!-- filter-group .// -->
