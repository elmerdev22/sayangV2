<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="form-row">
            <div class="col form-group">
                <label>First name</label>
                <input type="text" class="form-control text-capitalize @error('first_name') is-invalid @enderror" wire:model="first_name">
                @error('first_name') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="col form-group">
                <label>Last name</label>
                <input type="text" class="form-control text-capitalize @error('last_name') is-invalid @enderror" wire:model="last_name">
                @error('last_name') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Email <small class="text-muted">(We'll never share your email with anyone else.)</small></label> 
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
            @error('email') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Create password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password">
                @error('password') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>Confirm password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" wire:model="confirm_password">
                @error('confirm_password') 
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" wire:model="agree"> <div class="custom-control-label"> I am agree with <a href="#">Terms & Conditions</a>  </div> </label>
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
    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="{{route('login-redirect.socialite', ['provider' => 'facebook', 'type' => 'partner'])}}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="{{route('login-redirect.socialite', ['provider' => 'google', 'type' => 'partner'])}}" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>
</div>
