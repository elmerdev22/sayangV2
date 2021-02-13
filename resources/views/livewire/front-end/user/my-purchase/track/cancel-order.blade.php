<div>
    <form method="POST" wire:submit.prevent="update">
        <div class="form-group">
            <label for="cancelation_reason">Cancelation Reason</label>
            <textarea name="cancelation_reason" id="cancelation_reason" rows="5" placeholder="Input reason here..." class="form-control @error('cancelation_reason') is-invalid @enderror" wire:model.lazy="cancelation_reason" cols="30" rows="10"></textarea>
            @error('cancelation_reason')
                <span class="invalid-feedback">
                    <span>{{$message}}</span>
                </span>
            @enderror
        </div>

        <div class="text-right">
            <button type="button" class="btn btn-light" wire:loading.attr="disabled" wire:target="update" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="update">
                Submit <span class="fas fa-spin fa-spinner" wire:loading wire:target="update"></span>
            </button>
        </div>
    </form>
</div>
