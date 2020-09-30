<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Partner List</h5> 
        </div>
        <div class="card-body">
        	<!-- NOTE: Always put the show entries & search before the .table-responsive class -->
        	@include('back-end.layouts.includes.datatables.search')
        	<div class="table-responsive mt-3">
        		<table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
	        		<thead>
	        			<tr>
	        				<th class="table-sort" wire:click="sort('user_accounts.first_name|user_accounts.last_name')">
	        					Account 
	        					@include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.first_name|user_accounts.last_name'])
	        				</th>
		        			<th class="table-sort" wire:click="sort('partners.name')">
		        				Merchant Name 
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
		        			<th>Status</th>
		        			<th class="table-sort" wire:click="sort('user_accounts.created_at')">
		        				Date Registered 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.created_at'])
		        			</th>
		        			<th></th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@forelse($data as $row)
		        			<tr>
		        				<td>{{ucwords($row->account_first_name.' '.$row->account_last_name)}}</td>
		        				<td>{{ucfirst($row->partner_name)}}</td>
		        				<td>@if($row->barangay_id) {{$row->city_name.', '.$row->province_name}} @endif</td>
		        				<td>{{Utility::mobile_number_ph_format($row->contact_no)}}</td>
		        				<td>{{$row->email}}</td>
		        				<td>
		        					@if($row->is_activated) 
		        						<span class="badge badge-success">Activated</span>
		        					@else
		        						@if($row->status == 'done')
			        						<span class="badge badge-info">Activation</span>
	        							@else
			        						<span class="badge badge-warning">Pending</span>
		        						@endif
		        					@endif 
		        				</td>
		        				<td>{{date('F/d/Y', strtotime($row->date_registered))}}</td>
		        				<td class="text-center">
		        					<a href="javascript:void(0);" class="btn btn-sm btn-flat btn-primary" title="View Details"><i class="fas fa-eye"></i></a>
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