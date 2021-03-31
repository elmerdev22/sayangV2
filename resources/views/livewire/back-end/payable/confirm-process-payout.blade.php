<div>
    @if($data)
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm table-cell-nowrap">
                <thead>
                    <tr>
                        <th colspan="2">PAYOUT INFORMATION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Batch No.</th>
                        <td>{{$data->order_payment_payout_batch->batch_no}}</td>
                    </tr>
                    <tr>
                        <th>Payout No.</th>
                        <td>
                            <a class="text-blue" href="{{route('back-end.payable.information', ['payout_no' => $data->payout_no])}}">{{$data->payout_no}}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Partner</th>
                        <td>
                            <a class="text-blue" target="_blank" href="{{route('back-end.partner.profile', ['key_token' => $data->partner->user_account->key_token])}}">{{ucfirst($data->partner->name)}}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Coverage</th>
                        <td>{{date('M/d/Y', strtotime($data->order_payment_payout_batch->date_from))}} - {{date('M/d/Y', strtotime($data->order_payment_payout_batch->date_to))}}</td>
                    </tr>
                    <tr>
                        <th>Total Orders</th>
                        <td>{{number_format(Utility::order_payout_total_orders($data->id))}}</td>
                    </tr>
                    <tr>
                        <th>Sayang Commission</th>
                        <td>PHP {{number_format($data->sayang_commission,2)}}</td>
                    </tr>
                    <tr>
                        <th>Online Payment Fee</th>
                        <td>PHP {{number_format($data->paymongo_fee + $data->foreign_fee,2)}}</td>
                    </tr>
                    <tr>
                        <th>Net Amount</th>
                        <td>PHP {{number_format($data->net_amount,2)}}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>PHP {{number_format($data->total_amount,2)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <b>PARTNER BANK INFORMATION</b> <br>
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
        <form method="POST" wire:submit.prevent="update">
            <div class="form-group">
                <label for="payout_note">Note</label>
                <textarea name="payout_note" id="payout_note" rows="5" placeholder="Add some notes here..." class="form-control @error('payout_note') is-invalid @enderror" wire:model.lazy="payout_note"></textarea>
                @error('payout_note')
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
                <button type="button" class="btn btn-danger btn-sm" wire:loading.attr="disabled" wire:target="update, receipt" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="update, receipt">
                    Confirm Payout <span class="fas fa-spin fa-spinner" wire:loading wire:target="update"></span>
                </button>
            </div>
        </form>
    @endif
</div>
@push('scripts')
<script type="text/javascript">
    window.livewire.on('initialize_confirm_process_payout', param => {
        $('#modal-confirm_process_payout').modal('show');
        Swal.close();
    });
    window.livewire.on('close_modal_confirm_process_payout', param => {
        $('#modal-confirm_process_payout').modal('hide');
    });
</script>
@endpush
