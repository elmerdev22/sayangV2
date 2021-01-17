<div>
    <form method="POST" wire:submit.prevent="store">
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
                        No Receipt Selected 
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
                Process Payout <span class="fas fa-spin fa-spinner" wire:loading wire:target="store"></span>
            </button>
        </div>
    </form>
</div>
