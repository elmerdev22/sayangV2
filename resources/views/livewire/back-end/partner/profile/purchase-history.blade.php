<div>
    <div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Purchase History</h4>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
	       <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
        	{{-- @include('back-end.layouts.includes.datatables.search') --}}
        	<div class="table-responsive mt-3">
        		<table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
	        		<thead>
	        			<tr>
	        				<th class="table-sort">
	        					Purchase ID 
	        				</th>
		        			<th class="table-sort">
		        				User/Buyer
		        			</th>
		        			<th class="table-sort">
		        				Item
		        			</th>
		        			<th class="table-sort">
		        				Quantity 
		        			</th>
		        			<th class="table-sort">
		        				Price 
		        			</th>
		        			<th>Status</th>
		        			<th class="table-sort">
		        				Total 
		        			</th>
		        			<th class="table-sort">
		        				Purchase Date 
		        			</th>
		        			<th></th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@for($x=1; $x<=10; $x++)
	        				<tr>
	        					<td>{{rand(100000,999999)}}</td>
	        					<td>
	        						<a href="javascript:void(0)" class="text-blue" title="View User's Profile">{{rand(100000,999999)}}</a>
	        					</td>
	        					<td>{{rand(100000,999999)}}</td>
	        					<td>{{number_format(rand(1,1500), 0)}}</td>
	        					<td>&#x20B1; {{number_format(rand(1,1500), 2)}}</td>
	        					<td>
	        						@php $status = rand(1,4); @endphp
	        						
	        						@if($status == 1)
	        							<span class="badge badge-success">Completed</span>
	        						@elseif($status == 2)
	        							<span class="badge badge-info">Approved</span>
	        						@elseif($status == 3)
	        							<span class="badge badge-warning">Pending</span>
	        						@else
	        							<span class="badge badge-danger">Cancelled</span>
	        						@endif
	        					</td>
	        					<td>&#x20B1; {{number_format(rand(1,1500), 2)}}</td>
	        					<td>{{date('F/d/Y')}}</td>
	        					<td class="text-center">
		        					<a href="javascript:void(0);" class="btn btn-sm btn-flat btn-primary" title="View Details"><i class="fas fa-eye"></i></a>
		        				</td>
	        				</tr>
	        			@endfor
	        		</tbody>
	        	</table>
        	</div>
        	<!-- NOTE: Always put the pagination after the .table-responsive class -->
        	{{-- @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data]) --}}
        </div>
    </div>
</div>
