<div>
	<div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Banks & Cards</h4>
			<div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            @if(!$banks)
                <h4>No details yet</h4>
            @else
                @foreach($banks as $row)
                <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div>
                                <span class="fas fa-building-o"></span> <strong>{{$row->bank->name}}</strong> @if($row->is_default)<span class="badge badge-info">Default</span>@endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div title="Account Name">
                                <span class="fas fa-user"></span> {{ucwords($row->account_name)}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div title="Account No.">
                                <span class="fas fa-credit-card"></span> {{$row->account_no}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div>
                                <button type="button" class="btn btn-sm btn-default" @if($row->is_default) disabled @else onclick="set_default('{{$row->key_token}}')" @endif>Set as Default</button>
                            </div>
                        </div>
                    </div>
                </blockquote>
                @endforeach
            @endif
        </div>
    </div>
</div>
