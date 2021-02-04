<div>
    @if($order_no)
        <form method="POST" wire:submit.prevent="update">
            <div class="form-group">
                <label for="cancelation_reason">Cancelation Reason</label>
                <textarea name="cancelation_reason" id="cancelation_reason" rows="5" placeholder="Input reason here..." class="form-control @error('cancelation_reason') is-invalid @enderror" wire:model.lazy="cancelation_reason" cols="30" rows="10"></textarea>
                @error('cancelation_reason')
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="update">
                    Submit <span class="fas fa-spin fa-spinner" wire:loading wire:target="update"></span>
                </button>
                <button type="button" class="btn btn-danger btn-sm" wire:loading.attr="disabled" wire:target="update" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    @endif
</div>
@push('scripts')
<script type="text/javascript">
    window.livewire.on('initialize_cancel_order', param => {
        setTimeout(function (){
            $('#modal-cancel_order').modal('show');
            Swal.close();
        }, 2000);
    });
    window.livewire.on('initialize_order_placed', param => {
        $('#modal-cancel_order').modal('hide');
    });
</script>
@endpush