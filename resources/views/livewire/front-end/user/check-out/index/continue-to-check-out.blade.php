<div>
    <button type="button" onclick="proceed()" class="btn btn-primary btn-block">Continue to checkout <span wire:loading.attr="disabled" wire:loading wire:target="proceed"><i class="fas fa-spinner fa-spin"></i></span></button>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        window.addEventListener('message', ev => {
                if (ev.data === '3DS-authentication-complete') {
                    payment_3d_completed();
                }
            },
            false
        );
    });

    window.livewire.on('reprocess_payment_3d_completed', param => {
        payment_3d_completed();
    });

    window.livewire.on('payment_3d_secure', param => {
        var url = param['url'];
        $('#modal-payment_3rd_secure_iframe').html(`<iframe src="`+url+`" title="3D Secure" style="width: 100%; height: 70vh; border: 0px;"></iframe>`);
        setTimeout(function (){
            $('#modal-payment_3d_secure').modal('show'); 
        }, 2000);
    });

    function payment_3d_completed(){
        $('#modal-payment_3d_secure').modal('hide');
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Processing Payment...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                $.LoadingOverlay("hide");
                @this.call('paymongo_pay_card', null, true)
            }
        });
    }

    function proceed(){
        $.LoadingOverlay("show");
        @this.call('proceed')
    }
    
    window.livewire.hook('afterDomUpdate', () => {
        $.LoadingOverlay("hide");
    });
</script>
@endpush