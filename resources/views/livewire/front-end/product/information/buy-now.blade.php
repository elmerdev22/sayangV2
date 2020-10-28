<div>
    <p>Grab this item now!</p>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h4>Php {{number_format($product_post->buy_now_price, 2)}}</h4>
        </div>
        <div class="col-md-2 text-center">
            <span class="fas fa-times"></span>
        </div>
        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-default" id="btn-quantity-minus"><span class="fas fa-minus"></span></button>
                </div>
                <input type="number" class="form-control form-control-sm  text-center" id="quantity" min="0" max="{{$current_quantity}}" value="{{$quantity}}">
                <div class="input-group-append">
                    <button type="button" class="btn btn-default" id="btn-quantity-plus"><span class="fas fa-plus"></span></button>
                </div>
            </div>
        </div>
    </div>                 
    <div class="bg-warning py-1 px-2 mt-4">
        <h4 class="mb-0 text-white">Your Total: Php {{number_format($buy_now_price, 2)}}</h4>
    </div>
    <!-- <p>You save Php 40 (30% off)</p> -->

    <div class="card-footer bg-white">
        <div class="row">
            <div class="col-lg-6 col-md-12 p-1">
                <a href="{{url('my-cart')}}">
                    <button class="btn btn-default w-100"><span class="fas fa-shopping-cart"></span> Add to Cart</button>
                </a>
            </div>
            <div class="col-lg-6 col-md-12 p-1">
                <button class="btn btn-default w-100"><span class="fas fa-shopping-basket"></span> Checkout</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        quantityField('#quantity', '#btn-quantity-minus', '#btn-quantity-plus', 100);
        $(document).on('change', '#quantity', function (){
            @this.call('validate_quantity', $('#quantity').val())
        });
        $(document).on('change', '#quantity', function (){
            @this.call('validate_quantity', $('#quantity').val())
        });
        $(document).on('keyup', '#quantity', function (){
            @this.call('validate_quantity', $('#quantity').val())
        });
        $(document).on('click', '#btn-quantity-minus', function () {
            @this.call('validate_quantity', $('#quantity').val())
        });
        $(document).on('click', '#btn-quantity-plus', function () {
            @this.call('validate_quantity', $('#quantity').val())
        });
    });
</script>
@endpush