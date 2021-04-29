<div>
	<div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Operating Hours</h4>
			<div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-cell-nowrap table-sm">
                    <thead>
                        <tr>
                            <th>Days</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->operating_hours as $row)
                            <tr>
                                <td>{{$days[$row->day]}}</td>
                                <td>
                                    {{$row->open_time ? date('h:i A', strtotime($row->open_time)) : 'Not set'}}
                                </td>
                                <td>
                                    {{$row->close_time ? date('h:i A', strtotime($row->close_time)) : 'Not set'}}
                                </td>
                                <td>
                                    @if ($row->status)
                                        <span class="badge badge-success">Active</span>   
                                    @else 
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
