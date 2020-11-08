<div>
    <form class="form" wire:submit.prevent="change_pass">
        <div class="form-group">
            <span class="pb-3">Note: Automatically logout after change your password.</span>
        </div>
        <div class="form-group">
            <label>Current password* </label>
            <input type="password" class="form-control" placeholder="Enter current password" wire:model.lazy="current_password">
            @error('current_password')
			    <span class="text-danger">*{{$message}}</span>
			@enderror
			@if(session('error_change'))
			    <span class="text-danger">*{{session('error_change')}}</span>
			@endif
        </div>
        <div class="form-group">
            <label>New password* </label>
            <div>
                <input type="password" class="form-control" placeholder="Password" wire:model.lazy="new_password" />
                @error('new_password')
				    <span class="text-danger">{{$message}}</span>
				@enderror
            </div>
            <div class="mt-2">
                <input type="password" class="form-control"placeholder="Confirm Password" wire:model.lazy="password_confirmation"/>
                @error('password_confirmation')
				    <span class="text-danger">{{$message}}</span>
				@enderror
            </div>
        </div>
        <div class="form-group">
        	<button type="submit" class="btn btn-warning float-right">Save <span wire:loading wire:target="change_pass" class="fas fa-spinner fa-spin"></span></button>
        </div>
    </form>
</div>