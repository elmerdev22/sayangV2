<div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Buyer Name</th>
                    <th>Payment Method</th>
                    <th>Total Amount</th>
                    <th>Date Completed</th>
                    <th>Purchase Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    @php 
                        $buyer       = $row->order_payment->order->billing->user_account;
                        $buyer_name  = $buyer->first_name.' '.$buyer->last_name;
                        $order_total = Utility::order_total($row->order_payment->order->id);
                    @endphp
                    <tr>
                        <td>
                            <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_payment->order->order_no])}}" class="text-blue">{{$row->order_payment->order->order_no}}</a>
                        </td>
                        <td>
                            {{ucwords($buyer_name)}}
                        </td>
                        <td>
                            <span class="badge badge-info">{{ucfirst(str_replace('_', ' ', $row->order_payment->payment_method))}}</span>
                        </td>
                        <td>PHP {{number_format($order_total['total'],2)}}</td>
                        <td>{{date('M/d/Y', strtotime($row->order_payment->order->date_completed))}}</td>
                        <td>{{date('M/d/Y', strtotime($row->order_payment->order->created_at))}}</td>
                        <td>
                            <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_payment->order->order_no])}}" class="btn btn-warning btn-sm">View Order</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>