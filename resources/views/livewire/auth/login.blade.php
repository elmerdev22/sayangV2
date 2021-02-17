<div>
    <form wire:submit.prevent="authenticate">
        
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{Session::get('error')}}
            </div>
        @endif

        <div class="form-group">
            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" wire:model.lazy="email" value="{{ old('email') }}" placeholder="Email" autofocus="true">
            @error('email') 
                <span class="invalid-feedback" style="display: block;">
                    <span>{{$message}}</span>
                </span> 
            @enderror
        </div> <!-- form-group// -->
        <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="password" placeholder="Password" autocomplete="off">
            @error('password') 
                <span class="invalid-feedback" style="display: block;">
                    <span>{{$message}}</span>
                </span> 
            @enderror
        </div> <!-- form-group// -->
        <div class="form-group">
            <a href="{{ route('password.request') }}" class="float-right">Forgot password?</a> 
            <label class="float-left custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember" wire:model="remember"> 
            <div class="custom-control-label"> Remember </div> </label>
        </div> <!-- form-group form-check .// -->
        <div class="form-group">
            <button type="submit" wire:loading.attr="disabled" wire:target="authenticate" class="btn btn-primary text-white btn-block">
                Sign in <span wire:loading wire:target="authenticate" class="fa fa-spinner fa-spin"></span>
            </button>
        </div> <!-- form-group// -->    
    </form>
</div>
