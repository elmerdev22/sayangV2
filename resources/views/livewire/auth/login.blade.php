<div>
    <form wire:submit.prevent="authenticate">
        
        @if(Session::has('error'))
            <div class="text-danger p-2 mb-2 bg-danger">
                <i class="fas fa-exclamation-triangle"></i> {{Session::get('error')}}
            </div>
        @endif

        <div class="form-group">
            <div class="input-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email') 
                <span class="invalid-feedback" style="display: block;">
                    <span>{{$message}}</span>
                </span> 
            @enderror
        </div>
        
        <div class="form-group">
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password') 
                <span class="invalid-feedback" style="display: block;">
                    <span>{{$message}}</span>
                </span> 
            @enderror
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" wire:model="remember">
                    <label for="remember">Remember Me</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-warning text-white  btn-block btn-flat">Sign In</button>
            </div>
        </div>
    </form>
</div>
