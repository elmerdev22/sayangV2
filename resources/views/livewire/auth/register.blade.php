<div>
    <form method="POST" wire:submit.prevent="">
        <div class="form-row">
            <div class="col form-group">
                <label>First name</label>
                <input type="text" class="form-control" wire:model="first_name">
            </div>
            <div class="col form-group">
                <label>Last name</label>
                <input type="text" class="form-control" wire:model="last_name">
            </div>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" wire:model="email">
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label>Contact number</label>
            <input type="text" class="form-control" wire:model="contact_number">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Create password</label>
                <input class="form-control" type="password">
            </div>
            <div class="form-group col-md-6">
                <label>Confirm password</label>
                <input class="form-control" type="password">
            </div>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> I am agree with <a href="#">terms and contitions</a>  </div> </label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning text-white  btn-block"> Register  </button>
        </div>
    </form>
</div>
