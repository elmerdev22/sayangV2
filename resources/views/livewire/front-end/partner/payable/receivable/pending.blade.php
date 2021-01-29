<div>
    @if(count($data) > 0)
        <div class="card card-outline card-sayang">
            <div class="card-header">
                <h4 class="card-title">Payout - Incoming Receivable - (Orders via Card & E-Wallet)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                        <thead>
                            <tr>
                                <th>
                                    Payout No.
                                </th>
                                <th>
                                    From
                                </th>
                                <th>
                                    To
                                </th>
                                <th>
                                    Sayang Commission
                                </th>
                                <th>
                                    Online Payment Fee
                                </th>
                                <th>
                                    Net Amount
                                </th>
                                <th>
                                    Total Amount
                                </th>
                                <th>
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                                <tr>
                                    <td>
                                        <a href="{{route('front-end.partner.payable.information', ['payout_no' => $row->payout_no])}}" class="text-blue" title="Click to view payout information">
                                            {{$row->payout_no}}
                                        </a>
                                    </td>
                                    <td>{{date('M/d/Y', strtotime($row->date_from))}}</td>
                                    <td>{{date('M/d/Y', strtotime($row->date_to))}}</td>
                                    <td>{{number_format($row->sayang_commission,2)}}</td>
                                    <td>{{number_format($row->foreign_fee + $row->paymongo_fee,2)}}</td>
                                    <td>{{number_format($row->net_amount,2)}}</td>
                                    <td>{{number_format($row->total_amount,2)}}</td>
                                    <td>{{date('M/d/Y', strtotime($row->payout_date))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
