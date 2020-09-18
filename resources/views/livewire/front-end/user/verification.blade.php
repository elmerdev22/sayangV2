<div>
    <p class="login-box-msg">
        We sent 6 digit code in your email
        <br>
        <small>{{Auth::user()->email}}</small>
    </p>
    <form>
        <div class="form-group mb-3">
            <input type="text" class="form-control text-center" placeholder="Verifiation Code">
        </div>
        <div class="form-group mb-3">
            <form method="POST" wire:submit.prevent="update">
                <button type="button" class="btn btn-warning text-white btn-block">
                    Confirm Verification
                </button>
            </form>
        </div>
        <span class="text-center">Didn't receive code ? <a href="#" class="">Resend</a> or <a href="#" class="">Change Email</a></span>
    </form>
</div>
