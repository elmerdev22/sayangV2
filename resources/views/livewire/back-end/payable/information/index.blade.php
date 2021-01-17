<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <b>PARTNER : </b> <a class="text-blue" target="_blank" href="{{route('back-end.partner.profile', ['key_token' => $data->partner->user_account->key_token])}}" title="Click here to view profile">{{$data->partner->name}}</a>
            </div>
            <div class="form-group">
                <b>BATCH NO. : </b> {{$data->order_payment_payout_batch->batch_no}}
            </div>            
            <div class="form-group">
                <b>PAYOUT NO. : </b> {{$data->payout_no}}
            </div>
            <div class="form-group">
                <b>DATE : </b> {{date('M/d/Y', strtotime($data->order_payment_payout_batch->date_from))}} - {{date('M/d/Y', strtotime($data->order_payment_payout_batch->date_to))}}
            </div>
            <div class="form-group">
                <b>STATUS : </b> @if($data->status == 'pending') <span class="badge badge-warning">pending</span> @else <span class="badge badge-success">completed</span> @endif
            </div>
            <div class="form-group">
                <b>PAYOUT TYPE : </b> @if($data->order_payment_payout_batch->type == 'online_payment') <span class="badge badge-info">Payable</span> @else <span class="badge badge-info">Receivable</span> @endif
            </div>
            <div class="form-group">
                <b>TOTAL ORDERS : </b> {{number_format(Utility::order_payout_total_orders($data->id))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <b>Sayang Commission : </b> PHP {{number_format($data->sayang_commission,2)}}
            </div>
            <div class="form-group">
                <b>Online Payment Fee : </b> PHP {{number_format($data->foreign_fee + $data->paymongo_fee,2)}}
            </div>
            <div class="form-group">
                <b>Net Amount : </b> PHP {{number_format($data->net_amount,2)}}
            </div>
            <div class="form-group">
                <b>Total Amount : </b> PHP {{number_format($data->total_amount,2)}}
            </div>

            @if($data->status == 'completed')
                <div class="form-group">
                    <b>NOTE :</b> <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus numquam, accusamus aliquam facere.
                </div>
                <div class="form-group">
                    <a class="text-blue" href="javascript:void(0)"><i class="fas fa-download"></i> Download Receipt</a>
                </div>
            @else
                <div class="form-group">
                    <button type="button" data-toggle="modal" data-target="#modal-process_payout" class="btn btn-warning btn-sm"><i class="fas fa-check"></i> Process This Payout</button>
                </div>
            @endif
        </div>
    </div>
</div>
