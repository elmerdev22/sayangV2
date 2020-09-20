<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="form-row">
            <div class="col form-group">
                <input type="text" class="form-control text-capitalize @error('first_name') is-invalid @enderror" wire:model="first_name" placeholder="First Name">
                @error('first_name') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="col form-group">
                <input type="text" class="form-control text-capitalize @error('last_name') is-invalid @enderror" wire:model="last_name" placeholder="Last Name">
                @error('last_name') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" placeholder="Email">
            @error('email') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <input type="text" class="form-control @error('contact_no') is-invalid @enderror" wire:model="contact_no" id="contact_no" placeholder="Contact No.">
            @error('contact_no') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="Create Password">
                @error('password') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" wire:model="confirm_password" placeholder="Confirm Password">
                @error('confirm_password') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox text-dark"> <input type="checkbox" class="custom-control-input" wire:model="agree"> <div class="custom-control-label"> I am agree with <a href="#">Terms & Conditions</a>  </div> </label>
            @if(!$agree)
                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please Agree on our Terms & Conditions</span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning text-white btn-block">
                Register
            </button>
        </div> <!-- form-group// -->
    </form>
</div>
