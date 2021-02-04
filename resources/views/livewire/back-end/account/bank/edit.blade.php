<div>
    @if($admin_bank_account_id)
        <form method="POST" wire:submit.prevent="update">
            <div class="modal-body">
                <div class="form-group">
                    <select id="edit_bank" class="form-control @error('bank') is-invalid @enderror" name="bank" wire:model="bank">
                        <option value="">Select Bank</option>
                        @foreach($banks as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    @error('bank') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" id="edit_account_no" class="form-control text-capitalize @error('account_no') is-invalid @enderror" wire:model.lazy="account_no" placeholder="Account Number">
                    @error('account_no') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" id="edit_account_name" class="form-control text-capitalize @error('account_name') is-invalid @enderror" wire:model.lazy="account_name" placeholder="Account Name">
                    @error('account_name') 
                        <span class="invalid-feedback">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
                <div class="form-group">
                    <div class="icheck-primary">
                        <input type="checkbox" id="edit-is_active" wire:model="is_active">
                        <label for="edit-is_active">Active / Display to Partners</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button type="button" wire:loading.attr="disabled" wire:target="update" class="btn btn-flat btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="update" class="btn btn-flat btn-sm btn-warning">
                        <i class="fas fa-check"></i> Save <span wire:loading wire:target="update"><i class="fas fa-spinner fa-spin"></i></span>
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>
