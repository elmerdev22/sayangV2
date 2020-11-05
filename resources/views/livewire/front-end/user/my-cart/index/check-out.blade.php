<div>
    <div class="row">
        <div class="col-5">
            <dt>Total price:</dt>
        </div>
        <div class="col-7">
            <dd class="text-right">₱ {{number_format($total_price, 2)}}</dd>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <dt>Discount:</dt>
        </div>
        <div class="col-7">
            <dd class="text-right">₱ {{number_format($discount, 2)}}</dd>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <dt>Total:</dt>
        </div>
        <div class="col-7">
            <dd class="text-right h5"><strong>₱ {{number_format($total, 2)}}</strong></dd>
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col-12">
            <a class="btn btn-warning text-white w-100" 
                @if($is_disabled) 
                    onclick="no_item_alert()" 
                    href="javascript:void(0);" 
                @else 
                    href="{{route('front-end.user.check-out.index')}}" 
                @endif 
            > 
            <i class="fas fa-cart-plus"></i> Check Out 
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function no_item_alert(){
        Swal.fire({
            title: 'No Item Selected.',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            Swal.close();
        })
    }
</script>
@endpush