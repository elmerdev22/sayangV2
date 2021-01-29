<div>
    <div class="modal-body">
        @if(count($data) > 0)
            <h4>TOTAL ORDERS: {{number_format(count($data))}}</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th>
                                Order No. 
                            </th>
                            <th>
                                Purchase Date
                            </th>
                            <th>
                                Date Completed
                            </th>
                            <th>
                                Sayang Commission
                            </th>
                            <th>
                                Net Amount
                            </th>
                            <th>
                                Total Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $overall_total_commission = 0;
                            $overall_total_net_amount = 0;
                            $overall_total_amount     = 0;
                        @endphp
                        @foreach($data as $key => $row)
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
                                    <a target="_blank" href="{{route('front-end.partner.order-and-receipt.track', ['id' => $row->order_no])}}" class="text-blue">{{$row->order_no}}</a>
                                </td>
                                <td>{{date('M/d/Y', strtotime($row->created_at))}}</td>
                                <td>{{date('M/d/Y', strtotime($row->date_completed))}}</td>
                                <td>PHP {{number_format($sayang_comission['total_commission'], 2)}}</td>
                                <td>PHP {{number_format($sayang_comission['net_amount'], 2)}}</td>
                                <td>PHP {{number_format($total_amount, 2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th class="text-center" colspan="3">TOTAL</th>
                            <th>PHP {{number_format($overall_total_commission,2)}}</th>
                            <th>PHP {{number_format($overall_total_net_amount,2)}}</th>
                            <th>PHP {{number_format($overall_total_amount,2)}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <b>SAYANG BANK INFORMATION</b> <br>
                        @for($x=1;$x<=2;$x++)
                            <blockquote class="quote-warning">
                                <div class="text-muted">
                                    Sayang PH Bank <small class="text-muted"><i>(bank account, di pa ito dynamic)</i></small> <br>
                                    BDO Unibank Inc. <small class="text-muted"><i>(bank account, di pa ito dynamic)</i></small> <br>
                                    1028300000 <small class="text-muted"><i>(bank account, di pa ito dynamic)</i></small> <br>
                                </div>
                            </blockquote>
                        @endfor
                        <!-- <small class="text-muted">No bank account provided.</small> -->
                    </div>    
                </div>
                <div class="col-md-7">
                    <form method="POST" wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="payable_note">Note</label>
                            <textarea name="payable_note" id="payable_note" rows="5" placeholder="Add some notes here..." class="form-control @error('payable_note') is-invalid @enderror" wire:model.lazy="payable_note"></textarea>
                            @error('payable_note')
                                <span class="invalid-feedback">
                                    <span>{{$message}}</span>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="receipt">Upload Receipt</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="receipt" accept=".png, .jpeg, .jpg, .gif" wire:model="receipt">
                                    <label class="custom-file-label" for="receipt">
                                        @if($receipt) 
                                            {{$receipt->getClientOriginalName()}}
                                        @else 
                                            No Receipt Selected 
                                        @endif 
                                    </label>
                                </div>
                            </div>
                            <div class="text-success" wire:loading wire:target="receipt">
                                <span class="fas fa-spin fa-spinner"></span> Uploading...
                            </div>
                            <div>
                                <small>File Size: Maximum of 1MB</small>
                            </div>
                            <div>
                                <small>File Extension: .png, .jpeg, .jpeg</small>
                            </div>
                            @error('receipt')
                                <span class="invalid-feedback d-block">
                                    <span>{{$message}}</span>
                                </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-danger btn-sm" wire:loading.attr="disabled" wire:target="store, receipt" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="store, receipt">
                                Confirm <span class="fas fa-spin fa-spinner" wire:loading wire:target="store"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
        <h4 class="text-center text-muted">No Data Found</h4>
        @endif
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    window.livewire.on('payable_proceed', param => {
        setTimeout(function (){
            $('#modal-proceed').modal('show');
            Swal.close();
        },2500);
    });
    window.livewire.on('initialize_payable', param => {
        $('#modal-proceed').modal('hide');
    });

</script>
@endpush