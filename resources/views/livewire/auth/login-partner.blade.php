<div>
    <form method="POST" wire:submit.prevent="authenticate">
        @if(Session::has('error'))
            <div class="text-danger p-2 mb-2 bg-danger">
                <i class="fas fa-exclamation-triangle"></i> {{Session::get('error')}}
            </div>
        @endif
        <div class="form-group">
            <label>Email <small class="text-muted">(We'll never share your email with anyone else.)</small></label> 
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email" placeholder="Email Address">
            @error('email') 
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="password" placeholder="Password">
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
        <p>Not Yet a Partner? Sign Up Now</p>
        <a href="{{route('partner.register')}}" class="btn btn-block btn-warning">
          <span class="fas fa-edit"></span> Sign up
        </a>
    </div>
</div>
