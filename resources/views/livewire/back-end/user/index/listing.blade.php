<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> User List</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
        	<!-- NOTE: Always put the show entries & search before the .table-responsive class -->
        	@include('back-end.layouts.includes.datatables.search')
        	<div class="table-responsive mt-3">
        		<table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
	        		<thead>
	        			<tr>
	        				<th class="table-sort" wire:click="sort('user_accounts.first_name|user_accounts.last_name')">
	        					Name 
	        					@include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.first_name|user_accounts.last_name'])
	        				</th>
		        			<th class="table-sort" wire:click="sort('users.email')">
		        				Email 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'users.email'])
		        			</th>
		        			<th class="table-sort" wire:click="sort('user_accounts.contact_no')">
		        				Contact 
		        				@include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.contact_no'])
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
		        				<td>{{ucwords($row->first_name.' '.$row->last_name)}}</td>
		        				<td>
		        					@if($row->email) 
			        					{{$row->email}}
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
		        					@if($row->verified_at) 
			        					@if($row->is_blocked)
			        						<span class="badge badge-danger">Blocked</span>
	        							@else
			        						<span class="badge badge-success">Verified</span>
		        						@endif
		        					@else
		        						<span class="badge badge-warning">Not Verified</span>
		        					@endif 
		        				</td>
		        				<td>{{date('F/d/Y', strtotime($row->date_registered))}}</td>
		        				<td class="text-center">
		        					<a href="{{route('back-end.user.profile', ['key_token' => $row->key_token])}}" class="btn btn-sm btn-flat btn-primary" title="View Details"><i class="fas fa-eye"></i></a>
		        				</td>
		        			</tr>
	        			@empty
	        				<tr>
	        					<td colspan="6" class="text-center">No Data Found</td>
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