<div>
    <p>Grab this item now!</p>
    <div class="row justify-content-center">
        @if($allow_purchase == 'allowed')
            <div class="col-md-5">
                <h4>
                    {{Utility::currency_code()}}{{number_format($product_post->buy_now_price, 2)}} 
                </h4>
                <small><del>{{Utility::currency_code()}}{{number_format($product_post->product->regular_price, 2)}}</del></small>
            </div>
            <div class="col-md-2 text-center">
                <span class="fas fa-times"></span>
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" 
                            wire:loading.attr="disabled" 
                            wire:target="buy_now, add_to_cart, update_cart" 
                            class="btn btn-light" 
                            id="btn-quantity-minus" 
                            @if($quantity <= 1 || $force_disabled) 
                                disabled="true" 
                            @endif><span class="fas fa-minus"></span></button>
                    </div>
                    <input type="number" 
                        @if($force_disabled)
                            disabled="true"
                        @endif 
                        wire:loading.attr="readonly" 
                        wire:target="buy_now, add_to_cart, update_cart" 
                        class="form-control text-center input-number-remove-arrow" 
                        id="quantity" 
                        min="1" 
                        max="{{$current_quantity}}">
                    <div class="input-group-append">
                        <button type="button" 
                            wire:loading.attr="disabled" 
                            wire:target="buy_now, add_to_cart, update_cart" 
                            class="btn btn-light" 
                            id="btn-quantity-plus" 
                            @if($quantity >= $current_quantity || $force_disabled) 
                                disabled="true" 
                            @endif><span class="fas fa-plus"></span></button>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <h4>{{Utility::currency_code()}}{{number_format($product_post->buy_now_price, 2)}} </h4> 
                <small><del>{{Utility::currency_code()}}{{number_format($product_post->product->regular_price, 2)}}</del></small>
            </div>
        @endif
    </div>
    @if($allow_purchase == 'allowed')
        <p class="mt-2">From this purchase, you'll rescue</p>
        <small>
            <div class="row text-center">
                <div class="col-4">	
                    <figure class="item-feature">
                        <span class="text-primary"><i class="fa fa fa-seedling"></i></span> 
                        <span>10,000 trees  </span>
                    </figure> <!-- iconbox // -->
                </div><!-- col // -->
                <div class="col-4">	
                    <figure  class="item-feature">
                        <span class="text-info"><i class="fa fa fa-tint"></i></span>	
                        <span>10 gal of water</span>
                    </figure> <!-- iconbox // -->
                </div><!-- col // -->
                <div class="col-4">	
                    <figure  class="item-feature">
                        <span class="text-warning"><i class="fa fa fa-bolt"></i></span>
                        <span>10 kw of energry</span>
                    </figure> <!-- iconbox // -->
                </div> <!-- col // -->
            </div>
        </small>
        <p class="mt-4">You save {{Utility::currency_code()}}{{number_format($price_percentage['discount']), 2}} ({{$price_percentage['discount_percent']}}% off)</p>
        <div class="bg-primary py-1 px-2 rounded">
            <h4 class="mb-0 text-white">Your Total: {{Utility::currency_code()}}{{number_format($buy_now_price, 2)}}</h4>
        </div>
    @endif
    
    <div class="card-footer bg-white">
        @if($allow_purchase == 'allowed')
            <div class="row">
                <div class="col-lg-6 col-md-12 p-1">
                    <button type="button" class="btn btn-light btn-block" 
                        @if($force_disabled)
                            disabled="true"
                        @else
                            @if($component->check_cart_item()) 
                                wire:click="update_cart()"
                            @else 
                                wire:click="add_to_cart()"
                            @endif
                        @endif
                          
                        wire:target="buy_now, add_to_cart, update_cart" wire:loading.attr="disabled">
                        <span class="fas fa-shopping-cart"></span> Add to Cart <span wire:loading wire:target="add_to_cart, update_cart" class="fas fa-spinner fa-spin"></span>
                    </button>
                </div>
                <div class="col-lg-6 col-md-12 p-1">
                    <button type="button" 
                        @if($force_disabled)
                            disabled="true"
                        @else
                            @if($component->check_cart_item()) 
                                wire:click="buy_now(true)"
                            @else 
                                wire:click="buy_now()"
                            @endif
                        @endif
                        
                        class="btn btn-light w-100" 
                        wire:loading.attr="disabled" 
                        wire:target="buy_now, add_to_cart, update_cart"
                        >
                        <span class="fas fa-shopping-basket"></span> Buy Now <span wire:loading wire:target="buy_now" class="fas fa-spinner fa-spin"></span>
                    </button>
                </div>
            </div>
        @elseif($allow_purchase == 'login')
            <div class="row">
                <div class="col-12 p-1">
                    @if($force_disabled)
                        <div class="text-center">Item Not Available</div>
                    @else
                        <a href="{{route('front-end.product.information.login-redirect', [
                                'slug'      => $product_post->product->slug,
                                'key_token' => $product_post->key_token,
                                'type'      => 'buy_now'
                            ])}}" 
                            class="btn btn-light btn-block">
                            Login to Purchase
                        </a>
                    @endif
                    
                </div>
            </div>
        @elseif($allow_purchase == 'not_verified')
            <div class="row">
                <div class="col-12 p-1 text-center">
                    @if($force_disabled)
                        <div class="text-center">Item Not Available</div>
                    @else
                        Registered email not verified
                    @endif
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12 p-1 text-center">
                    @if($force_disabled)
                        <div class="text-center">Item Not Available</div>
                    @else
                        <p class="font-weight-bold">Login as User to Purchase</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('#quantity').val('{{$quantity}}');
        quantityField('#quantity', '#btn-quantity-minus', '#btn-quantity-plus');
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
    
    window.livewire.on('buy_now_quantity_value', param => {
        $(document).find('#quantity').val(param['quantity']);
    });

    var event_channel = push_init.subscribe('product-post-update-channel');
    event_channel.bind('product-post-update-event', function(param) {
        @this.call('product_post_update_event', param)
    });
</script>
@endpush