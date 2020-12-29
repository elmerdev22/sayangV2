<div>
    <p class="login-box-msg">
        We sent 6 digit code in your email
        <br>
        <small>{{Auth::user()->email}}</small>
    </p>

    <form wire:submit.prevent="verify">
        <div class="form-group">
            <div class="input-group">
                <input type="text" wire:model.lazy="verification_code" style="letter-spacing: 8px;" maxlength="6" autofocus="true" class="form-control text-center" placeholder="XXXXXX">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-outline-secondary" onclick="resend()" id="btn-resend" {{$resend ? '':'disabled="true"'}}>Resend <span wire:loading wire:target="resend" class="fas fa-spinner fa-spin"></span> <span id="btn-resend-count">{{$resend ? '':'(30)'}}</span></button>
                </div>
            </div>
            @if($error_message)
                <div class="text-center text-danger mt-2">
                    <span><i class="fas fa-exclamation-triangle"></i> {!!$error_message!!}</span>
                </div>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-warning text-white btn-block">
                Confirm Verification <span wire:loading wire:target="verify" class="fas fa-spinner fa-spin"></span>
            </button>
        </div>
        <span class="text-center">Didn't receive code ? <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-change_email" class="text-blue">Change Email</a></span>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var fix_seconds    = 30;
        var resend_seconds = fix_seconds;
        var resend_counter = 0;
        var set            = true;

        setInterval(() => {
            if(resend_counter < fix_seconds){
                $('#btn-resend-count').html('('+resend_seconds+')');
                resend_seconds--;
                resend_counter++;
            }else{
                if(set){
                    $('#btn-resend #btn-resend-count').html('');
                    @this.set('resend', true);
                    set = false;
                }
            }
        }, 1000);

        window.livewire.on('reset_resend', param => {
            resend_seconds = fix_seconds;
            resend_counter = 0;
            set            = true;
        });
    });

    function resend(){
        $('#btn-resend').attr('disabled', true);
        @this.call('resend');
    }
</script>
@endpush