<div>
    <form wire:submit.prevent='add_main_category'>
        <div class="form-group">
            <label>Category<i class='text-danger'>*</i></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model='name' autofocus>
            @error('name') <span class="error text-danger small">{{ $message }}</span> @enderror
        </div>
        <div class="float-right">
            <button class="btn btn-success">
                <i class="fas fa-check"></i> Save
            </button>
        </div>
    </form>
</div>
