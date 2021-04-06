<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="form-row">
            <div class="col form-group">
                <label>First name</label>
                <input type="text" class="form-control text-capitalize @error('first_name') is-invalid @enderror" wire:model="first_name" autocomplete="off">
                @error('first_name') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>Last name</label>
                <input type="text" class="form-control text-capitalize @error('last_name') is-invalid @enderror" wire:model="last_name" autocomplete="off">
                @error('last_name') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" autocomplete="off">
            @error('email') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div> <!-- form-group end.// -->
        
        
        <div class="form-group">
            <label>Contact no.</label>
            <input type="text" class="form-control @error('contact_no') is-invalid @enderror" wire:model="contact_no" id="contact_no" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  autocomplete="off">
            @error('contact_no') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Create password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" autocomplete="off">
                @error('password') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>Confirm password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" wire:model="confirm_password" autocomplete="off">
                @error('confirm_password') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="agree" wire:model="agree"> 
                <div class="custom-control-label"> I agree with the 
                    <a target="_blank" href="{{route('front-end.terms-and-conditions.index')}}">Terms and Conditions</a>  
                </div> 
            </label>

            @if(!$agree && $agree_post) 
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Please agree on our Terms & Conditions
                </div>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary text-white  btn-block"> Register <span wire:loading wire:target="store" class="fas fa-spinner fa-spin"></span> </button>
        </div>     
    </form>
</div>
