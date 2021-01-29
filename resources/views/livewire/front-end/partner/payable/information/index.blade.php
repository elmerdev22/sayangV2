<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <b>BATCH NO. : </b> {{$data->order_payment_payout_batch->batch_no}}
            </div>            
            <div class="form-group">
                <b>PAYOUT NO. : </b> {{$data->payout_no}}
            </div>
            @if($data->order_payment_payout_batch->date_from && $data->order_payment_payout_batch->date_to)
                <div class="form-group">
                    <b>DATE COVERAGE : </b> {{date('M/d/Y', strtotime($data->order_payment_payout_batch->date_from))}} - {{date('M/d/Y', strtotime($data->order_payment_payout_batch->date_to))}}
                </div>
            @endif
            <div class="form-group">
                <b>PAYOUT DATE : </b> {{date('F/d/Y', strtotime($data->created_at))}}
            </div>
            <div class="form-group">
                <b>PAYOUT TYPE : </b> @if($data->order_payment_payout_batch->type == 'online_payment') <span class="badge badge-info">Payable</span> @else <span class="badge badge-info">Receivable</span> @endif
            </div>
            <div class="form-group">
                <b>STATUS : </b> 
                @if($data->status == 'pending')
                    <span class="badge badge-warning">pending</span> 
                @else 
                    <span class="badge badge-success">completed</span> <small class="text-muted">@ {{date('F/d/Y', strtotime($data->date_completed))}}</small>
                @endif
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
            <div class="form-group">
                <b>Total Orders : </b> {{number_format(Utility::order_payout_total_orders($data->id))}}
            </div>
            @if($data->status == 'completed')
                @if($data->note)
                    <div class="form-group">
                        <b>NOTE :</b> <br>
                        {!!$data->note!!}
                    </div>
                @endif

                @if($payout_receipt != null)
                    <div class="form-group">
                        <a class="text-blue" href="{{$payout_receipt->getFullUrl()}}" download="{{$payout_receipt->file_name}}"><i class="fas fa-download"></i> Download Receipt</a>
                    </div>
                @else
                    <div class="mt-3 text-muted">No uploaded receipt.</div>
                @endif
                
            @else
                <div class="form-group">
                    <b>YOUR PREFERRED BANK INFORMATION</b> <br>
                    @if($data->partner->partner_bank_accounts)
                        @foreach($data->partner->partner_bank_accounts as $bank)
                            <div class="mb-3 text-muted">
                                {{ucwords($bank->bank->name)}} <br>
                                {{ucwords($bank->account_name)}} <br>
                                {{$bank->account_no}}
                            </div>
                        @endforeach
                    @else
                        <small class="text-muted">No bank account provided.</small>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>