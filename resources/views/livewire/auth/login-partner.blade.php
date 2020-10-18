<div>
    <form method="POST" wire:submit.prevent="authenticate">
        @if(Session::has('error'))
            <div class="text-danger p-2 mb-2 bg-danger">
                <i class="fas fa-exclamation-triangle"></i> {{Session::get('error')}}
            </div>
        @endif
        <div class="form-group">
            <label>Email <small class="text-muted">(We'll never share your email with anyone else.)</small></label> 
            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" wire:model.lazy="email" value="{{ old('email') }}" placeholder="Email" autofocus="true">
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
                Login <span wire:loading wire:target="authenticate" class="fas fa-spinner fa-spin"></span>
            </button>
        </div> <!-- form-group// -->
    </form>
    <div class="social-auth-links text-center">
        <p>Not Yet a Partner? Sign Up Now</p>
        <a href="{{route('partner.register')}}" class="btn btn-block btn-warning">
            Sign up 
        </a>
    </div>
</div>
