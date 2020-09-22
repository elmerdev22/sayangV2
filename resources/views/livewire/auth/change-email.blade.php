<div>
    <form id="form-change_email" wire:submit.prevent="update">
        <div class="form-group">
            <label for="new_email">New Email Address*</label>
            <input type="text" name="new_email" id="new_email" wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror" placeholder="New Email">
            @error('email')
                <span class="invalid-feedback">
                    <span>{{$message}}</span>
                </span>
            @enderror
        </div>
    </form>
</div>
