<div>
    @if($qr_code)
        {!! QrCode::size(200)->generate($qr_code); !!}
    @endif
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('initialize_qr_code', param => {

        setTimeout(function (){
            Swal.close();
            $('#modal-qr_code_order_no').html(param['order_no']);
            $('#modal-qr_code').modal('show');
        }, 1500);
    });
</script>
@endpush