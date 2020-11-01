<div>
    @forelse($banks as $row)
        <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div>
                        <span class="fas fa-building-o"></span> <strong>{{$row->bank->name}}</strong> 
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
                    @if(!$row->is_default)
                        <button type="button" class="btn btn-sm btn-default">Set Default</button>
                    @else
                        <button type="button" class="btn btn-sm btn-default" disabled="true">Set Default</button>
                        <span class="badge badge-info">Default</span>
                    @endif
                </div>
            </div>
        </blockquote>
    @empty
        <p class="text-center">You don't have bank account yet.</p>
    @endif
</div>
