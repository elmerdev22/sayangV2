<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Filter Partners</h5> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Account Status</label>
                    <select class="form-control" wire:model="account_status">
                        <option value="" selected>All</option>
                        <option value="activated">Activated</option>
                        <option value="for_activation">For Activation</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Block Status</label>
                    <select class="form-control" wire:model="block_status">
                        <option value="" selected>All</option>
                        <option value="1">Blocked</option>
                        <option value="0">Not Blocked</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Date Registered From</label>
                    <input type="date" class="form-control" wire:model="date_from" max="{{$date_to}}">
                    @if(session('date_from_error')) 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{session('date_from_error')}}</span>
                        </span> 
                    @endif
                </div>
                <div class="col-md-6">
                    <label>Date Registered To</label>
                    <input type="date" class="form-control" wire:model="date_to" max="{{date('Y-m-d')}}" min="{{$date_from}}">
                    @if(session('date_to_error')) 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{session('date_to_error')}}</span>
                        </span> 
                    @endif
                </div>
            </div>
            @if ($reset_filter)
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-warning w-25" wire:click="reset_filter">Reset Filter <span wire:loading wire:target="reset_filter" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </div>
            @endif
        </div>
    </div> <!-- card.// -->
	<div class="card mb-3">
        <div class="card-body">
        	<!-- NOTE: Always put the show entries & search before the .table-responsive class -->
        	@include('back-end.layouts.includes.datatables.search')
        	<div class="table-responsive mt-3">
        		<table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
	        		<thead>
	        			<tr>
	        				<th class="table-sort" wire:click="sort('user_accounts.first_name|user_accounts.last_name')">
	        					Account Name
	        					@include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.first_name|user_accounts.last_name'])
	        				</th>
		        			<th class="table-sort" wire:click="sort('partners.name')">
		        				Partner Name 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.name'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('partners.address|philippine_barangays.name|philippine_cities.name|philippine_provinces.name|philippine_regions.name')">	Address 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.address|philippine_barangays.name|philippine_cities.name|philippine_provinces.name|philippine_regions.name'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('partners.contact_no')">
		        				Contact 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.contact_no'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('partners.email')">
		        				Email 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.email'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('users.is_blocked')">
		        				Status 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'users.is_blocked'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('user_accounts.created_at')">
		        				Date Registered 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.created_at'])
		        			</th>
		        			<th>
								Action
							</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@forelse($data as $row)
		        			<tr>
		        				<td>{{ucwords($row->account_first_name.' '.$row->account_last_name)}}</td>
		        				<td>
		        					@if($row->partner_name) 
		        						{{ucfirst($row->partner_name)}} 
		        					@else 
		        						<i class="text-danger">not set</i> 
		        					@endif
		        				</td>
		        				<td>
		        					@if($row->barangay_id) 
		        						{{$row->city_name.', '.$row->province_name}} 
	        						@else 
	        							<i class="text-danger">not set</i> 
	        						@endif
		        				</td>
		        				<td>
		        					@if($row->contact_no)
			        					{{Utility::mobile_number_ph_format($row->contact_no)}}
		        					@else
	        							<i class="text-danger">not set</i>
		        					@endif
		        				</td>
		        				<td>
		        					@if($row->email)
			        					{{$row->email}}
		        					@else
	        							<i class="text-danger">not set</i>
		        					@endif
		        				</td>
		        				<td>
		        					@if($row->is_activated) 
		        						<span class="badge badge-success">Activated</span>
		        					@else
		        						@if($row->status == 'done')
			        						<span class="badge badge-info">For Activation</span>
	        							@else
			        						<span class="badge badge-warning">Pending</span>
		        						@endif
		        					@endif 
		        				</td>
		        				<td>{{date('M/d/Y', strtotime($row->date_registered))}}</td>
		        				<td class="text-center">
		        					<a href="{{route('back-end.partner.profile', ['key_token' => $row->account_key_token])}}" class="btn btn-sm btn-flat btn-warning" title="View Details"><i class="fas fa-eye"></i></a>
		        				</td>
		        			</tr>
	        			@empty
	        				<tr>
	        					<td colspan="8" class="text-center">No Data Found</td>
	        				</tr>
	        			@endforelse
	        		</tbody>
	        	</table>
        	</div>
        	<!-- NOTE: Always put the pagination after the .table-responsive class -->
        	@include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div>
</div>