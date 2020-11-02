<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="modal-body">
            <div class="form-group">
                <select id="bank" class="form-control @error('bank') is-invalid @enderror" name="bank" wire:model="bank">
                    <option value="">Select Bank</option>
                    @foreach($component->banks() as $row)
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
                <input type="text" id="account_no" class="form-control text-capitalize @error('account_no') is-invalid @enderror" wire:model.lazy="account_no" placeholder="Account Number">
                @error('account_no') 
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span> 
                @enderror
            </div>
            <div class="form-group">
                <input type="text" id="account_name" class="form-control text-capitalize @error('account_name') is-invalid @enderror" wire:model.lazy="account_name" placeholder="Account Name">
                @error('account_name') 
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span> 
                @enderror
            </div>
            <div class="form-group">
                <div class="icheck-primary">
                    <input type="checkbox" id="is_default" @if($force_default) disabled checked @else wire:model="is_default" @endif>
                    <label for="is_default">Set as default address</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="text-right">
                <button type="button" wire:loading.attr="disabled" wire:target="store" class="btn btn-flat btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                <button type="submit" wire:loading.attr="disabled" wire:target="store" class="btn btn-flat btn-sm btn-success">
                    <i class="fas fa-check"></i> Add <span wire:loading wire:target="store"><i class="fas fa-spinner fa-spin"></i></span>
                </button>
            </div>
        </div>
    </form>
</div>
