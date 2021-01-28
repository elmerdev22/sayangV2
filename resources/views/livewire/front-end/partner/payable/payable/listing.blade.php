<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Payout - Payable - (Orders via COP)</h4>
        </div>
        <div class="card-body">  
            <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
            {{--@include('back-end.layouts.includes.datatables.search')--}}
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th class="table-sort" wire:click="sort('orders.order_no')">
                                Order No. 
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.order_no'])
                            </th>
                            <th class="table-sort" wire:click="sort('orders.created_at')">
                                Purchase Date
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.created_at'])
                            </th>
                            <th class="table-sort">
                                Date Completed
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'orders.date_completed'])
                            </th>
                            <th class="table-sort">
                                Sayang Commission
                            </th>
                            <th class="table-sort">
                                Net Amount
                            </th>
                            <th class="table-sort">
                                Total Amount
                            </th>
                            <th class="text-center">SELECT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $overall_total_commission = 0;
                            $overall_total_net_amount = 0;
                            $overall_total_amount     = 0;
                        @endphp
                        @forelse($data as $key => $row)
                            @php 
                                $total_amount              = $component->order_total($row->order_id);
                                $sayang_comission          = Utility::sayang_commission($total_amount);
                                $overall_total_commission += $sayang_comission['total_commission'];
                                $overall_total_amount     += $total_amount;
                                $overall_total_net_amount += $sayang_comission['net_amount'];
                            @endphp
                            <tr>
                                <th>{{$key+1}}.)</th>
                                <td>
                                    <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="text-blue">{{$row->order_no}}</a>
                                </td>
                                <td>{{date('M/d/Y', strtotime($row->created_at))}}</td>
                                <td>{{date('M/d/Y', strtotime($row->date_completed))}}</td>
                                <td>PHP {{number_format($sayang_comission['total_commission'], 2)}}</td>
                                <td>PHP {{number_format($sayang_comission['net_amount'], 2)}}</td>
                                <td>PHP {{number_format($total_amount, 2)}}</td>
                                <td class="text-center">
                                    <div class="">
                                        <input type="checkbox" onclick="select_order('{{$row->order_key_token}}')" id="select-{{$row->order_key_token}}">
                                        <label for="select-{{$row->order_key_token}}"></label>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-muted text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th class="text-center" colspan="3">TOTAL</th>
                            <th>PHP {{number_format($overall_total_commission,2)}}</th>
                            <th>PHP {{number_format($overall_total_net_amount,2)}}</th>
                            <th>PHP {{number_format($overall_total_amount,2)}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-warning btn-sm">Proceed Selected Orders <i class="fas fa-caret-right"></i></button>
                </div>
            </div>
            <!-- NOTE: Always put the pagination after the .table-responsive class -->
            {{--@include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])--}}
        </div>
    </div>
</div>