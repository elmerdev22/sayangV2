<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="form-group">
            <label>Email <small class="text-muted">(We'll never share your email with anyone else.)</small></label> 
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" placeholder="Email Address">
            @error('email') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="Password">
            @error('password') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning text-white btn-block">
                <span class="fas fa-sign-in-alt mr-2"></span>Login
            </button>
        </div> <!-- form-group// -->
    </form>
    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="{{route('partner.register')}}" class="btn btn-block btn-warning">
          Sign up
        </a>
    </div>
</div>
