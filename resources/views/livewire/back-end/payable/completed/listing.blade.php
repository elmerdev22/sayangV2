<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Completed Payables & Receivables</h5>
        </div>
        <div class="card-body">  
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
            <!-- @include('back-end.layouts.includes.datatables.search') -->
    
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th class="table-sort" wire:click="sort('partners.name')">
                                Partner
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.name'])
                            </th>
                            <th>Sayang Commission</th>
                            <th>Online Payment Fee</th>
                            <th>Net Amount</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>
                                    <a class="text-blue" href="javascript:void(0);">{{ucfirst($row->partner_name)}}</a>
                                </td> 
                                <td>PHP {{number_format($row->overall_sayang_commission,2)}}</td>
                                <td>PHP {{number_format($row->overall_foreign_fee + $row->overall_paymongo_fee,2)}}</td>
                                <td>PHP {{number_format($row->overall_net_amount,2)}}</td>
                                <td>PHP {{number_format($row->overall_total_amount,2)}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{route('back-end.payable.completed.information', ['partner_slug' => $row->partner_slug])}}">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Result Found</td>
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
