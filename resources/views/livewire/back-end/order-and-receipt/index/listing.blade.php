<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Filter Orders & Receipts</h5> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Partner</label>
                    <select class="form-control" wire:model="partner">
                        <option value="" selected>All</option>
                        @forelse ($partners as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @empty
                            <option>No Partner.</option>    
                        @endforelse
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Order Status</label>
                    <select class="form-control" wire:model="status">
                        <option value="" selected>All</option>
                        <option value="order_placed">Order Placed (COP)</option>
                        <option value="payment_confirmed">Payment Confirmed</option>
                        <option value="to_receive">To Receive</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Date Purchased From</label>
                    <input type="date" class="form-control" wire:model="date_from" max="{{$date_to}}">
                    @if(session('date_from_error')) 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{session('date_from_error')}}</span>
                        </span> 
                    @endif
                </div>
                <div class="col-md-6">
                    <label>Date Purchased To</label>
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

    <div class="card">
        <div class="card-body">  
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
            @include('back-end.layouts.includes.datatables.search')
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th class="table-sort" wire:click="sort('orders.order_no')">
                                Order No. 
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.order_no'])
                            </th>
                            <th class="table-sort" wire:click="sort('partners.name')">
                                Partner
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.name'])
                            </th>
                            <th class="table-sort" wire:click="sort('user_accounts.first_name|user_accounts.last_name')">
                                Buyer Name
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'user_accounts.first_name|user_accounts.last_name'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Payment
                                <!-- @include('back-end.layouts.includes.datatables.sort', ['field' => 'order_payments.payment_method']) -->
                            </th>
                            <th class="table-sort" wire:click="sort('orders.status')">
                                Status
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.status'])
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{$row->order_no}}</td>
                                <td>{{ucfirst($row->partner_name)}}</td>
                                <td>{{ucwords($row->user_account_first_name.' '.$row->user_account_last_name)}}</td>
                                <td>{{date('F/d/Y', strtotime($row->created_at))}}</td>
                                <td>
                                    @if($row->payment_method == 'cash_on_pickup')
                                        <span class="badge badge-info">Cash on Pickup</span>
                                    @else
                                        @if($row->order_payment_status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($row->order_payment_status == 'paid')
                                            <span class="badge badge-info">{{ucfirst(str_replace('_', '-', $row->payment_method))}}</span>
                                        @else
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($row->status == 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @elseif($row->status == 'order_placed')
                                        <span class="badge badge-warning">Order Placed</span>
                                    @elseif($row->status == 'payment_confirmed')
                                        <span class="badge badge-info">Payment Confirmed</span>
                                    @elseif($row->status == 'to_receive')
                                        <span class="badge badge-info">To Receive</span>
                                    @elseif($row->status == 'completed')
                                        <span class="badge badge-success">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('back-end.order-and-receipt.track', ['order_no' => $row->order_no])}}" class="btn btn-warning btn-sm">Track</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
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
