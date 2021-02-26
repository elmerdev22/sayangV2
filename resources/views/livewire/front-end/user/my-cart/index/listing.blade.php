<div>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-borderless table-shopping-cart">
                @if(count($data) > 0)
                    <thead class="text-muted">
                        <tr class="small text-uppercase">
                            <th scope="col" width="5" class="text-center">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" 
                                            class="custom-control-input"
                                            @if($is_disabled_all) 
                                                disabled="true"
                                            @else 
                                                onclick="select_all_items()"
                                                id="check-all"
                                                @if($is_check_all)
                                                    checked="true"
                                                @endif
                                            @endif
                                        >
                                    <div class="custom-control-label" for="check-all"></div>
                                </label>
                            </th>
                            <th scope="col">Product</th>
                            <th scope="col" width="200">Quantity</th>
                            <th scope="col" width="150">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" 
                                        @if($row['is_disabled']) 
                                            disabled="true"
                                            class="custom-control-input"
                                        @else 
                                            onclick="select_store_items('{{$key}}')"
                                            id="check-store-{{$key}}"
                                            class="check-store custom-control-input"
                                            @if($row['is_check_all'])
                                                checked="true"
                                            @endif
                                        @endif
                                        >
                                    <div class="custom-control-label" for="check-store-{{$key}}"></div>
                                </label>
                            </td>
                            <td>
                                <span class="fas fa-store"></span> {{strtoupper($row['partner_name'])}}
                            </td>
                        </tr> 
                        @foreach($row['products'] as $product_key => $product_row)
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox ">
                                        <input type="checkbox" 
                                            @if($product_row['is_disabled']) 
                                                disabled="true"
                                                class="custom-control-input"
                                            @else
                                                @if($product_row['is_checkout'])
                                                    checked="true"
                                                @endif
                                                class="check-item check-store-{{$key}} custom-control-input" 
                                                data-key_token="{{$product_row['cart_key_token']}}" 
                                                id="check-{{$product_row['cart_key_token']}}" 
                                                onclick="select_to_checkout_items()"
                                            @endif
                                        >
                                        <div class="custom-control-label" for="check-{{$product_row['cart_key_token']}}"></div>
                                    </label>
                                </td>
                                <td>
                                    <figure class="itemside align-items-center">
                                        <div class="aside">
                                            <img src="{{$product_row['featured_photo']}}" class="img-sm">
                                        </div>
                                        <figcaption class="info">
                                            <a href="{{route('front-end.product.information.redirect', [
                                                'slug'      => $product_row['product_slug'],
                                                'key_token' => $product_row['product_post_key_token'],
                                                'type'      => 'buy_now'
                                            ])}}"
                                            class="title text-dark">{{$product_row['name']}}</a>
                                            <p class="text-muted small">
                                                <small class="bg-primary p-1 rounded text-white"> 
                                                    <span class="fas fa-clock"></span> 
                                                    @if($product_row['post_status'] != 'active')
                                                        <span>{{ucfirst($product_row['post_status'])}}</span> 
                                                    @else
                                                        <span class="countdown">{{$product_row['date_end']}}</span>
                                                    @endif
                                                </small> 
                                            </p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td> 
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" 
                                                @if($product_row['is_disabled']) 
                                                    disabled="true" 
                                                @else
                                                    onclick="quantity_update('{{$product_row['cart_key_token']}}', false)"
                                                @endif 
                                                    id="btn-quantity-minus-{{$product_row['cart_key_token']}}" 
                                                    class="btn btn-light btn-quantity-minus" 
                                            ><span class="fas fa-minus"></span></button>
                                        </div>
                                        <input type="number" 
                                            @if($product_row['is_disabled']) 
                                                disabled="true" 
                                            @else
                                                onkeyup="quantity_update('{{$product_row['cart_key_token']}}', 'force')"
                                            @endif 
                                            class="form-control text-center input-number-remove-arrow quantity" 
                                            id="quantity-{{$product_row['cart_key_token']}}"
                                            min="1" max="{{$product_row['current_quantity']}}"
                                            data-key_token="{{$product_row['cart_key_token']}}"
                                            value="{{$product_row['selected_quantity']}}"
                                            >
                                        <div class="input-group-append">
                                            <button type="button" 
                                                @if($product_row['is_disabled'] || $product_row['selected_quantity'] == $product_row['current_quantity']) 
                                                    disabled="true" 
                                                @else
                                                    onclick="quantity_update('{{$product_row['cart_key_token']}}')"
                                                @endif 
                                                class="btn btn-light btn-quantity-plus" 
                                                id="btn-quantity-plus-{{$product_row['cart_key_token']}}" 
                                            ><span class="fas fa-plus"></span></button>
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="price-wrap @if($product_row['is_disabled']) text-line-through @endif">
                                        <var class="price">
                                            {{Utility::currency_code()}}{{number_format($product_row['total_price'], 2)}}
                                        </var> 
                                        <small class="text-muted @if($product_row['is_disabled']) text-line-through @endif"> 
                                            {{Utility::currency_code()}}{{number_format($product_row['buy_now_price'], 2)}} each 
                                        </small> 
                                    </div> <!-- price-wrap .// -->
                                </td>
                                <td class="text-right"> 
                                    <a href="javascript:void(0);" class="btn btn-light" onclick="delete_item('{{$product_row['cart_key_token']}}')">Remove</a> 
                                </td>
                            </tr>
                        @endforeach
                        
                        <tr class="border-top">
                            <td colspan="3"></td>
                            <td>
                                <div class="price-wrap"> 
                                    <div class="price">
                                        @if($row['is_disabled']) 
                                            {{Utility::currency_code()}} 0.00
                                        @else
                                            {{Utility::currency_code()}} {{number_format($row['sub_total'], 2)}}
                                        @endif
                                    </div> 
                                    <small class="text-muted"> SUB-TOTAL </small> 
                                </div> <!-- price-wrap .// -->
                            </td>
                            <td></td>
                        </tr>
                    @empty
                        <tr class="text-center bg-white">
                            <td colspan="5" class="text-center">
                                <img width="150" src="https://image.freepik.com/free-vector/user-rating-feedback-customer-reviews-cartoon-web-icon-e-commerce-online-shopping-internet-buying-trust-metrics-top-rated-product_335657-778.jpg">
                                <p>
                                    Your Cart is Empty!
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            <a href="/" class="btn btn-light"> « Continue Shopping</a>
        </div> <!-- card-body.// -->
    </div> <!-- card.// -->
</div>

@push('scripts')
<script type="text/javascript">
    
    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $('.countdown').countdown("start");
    });
    
    $('.countdown').countdown({
        end: function() {
            @this.call('initialize')
            @this.call('render')
            @this.call('set_initialize_cart_checkout')
        }
    });
    document.addEventListener('DOMContentLoaded', function (event) {
        $(document).find('.quantity').each(function (){
            var key_token = $(this).data('key_token');
            quantityField('#quantity-'+key_token, '#btn-quantity-minus-'+key_token, '#btn-quantity-plus-'+key_token);
        });
    });
    window.livewire.on('remove_card_listing_loader', param => {
        $('#card-cart-listing').LoadingOverlay("hide");
    });
    var event_channel = push_init.subscribe('product-post-update-channel');
    event_channel.bind('product-post-update-event', function(param) {
        @this.call('product_post_update_event', param)
    });
    function select_all_items(){
        if($(document).find('#check-all').is(':checked')){
            $(document).find('.check-item').each(function (){
                $(this).prop('checked', true);
            });
            $(document).find('.check-store').each(function (){
                $(this).prop('checked', true);
            });
        }else{
            $(document).find('.check-item').each(function (){
                $(this).prop('checked', false);
            });
            $(document).find('.check-store').each(function (){
                $(this).prop('checked', false);
            });
        }
        select_to_checkout_items();
    }
    function select_store_items(key_token){
        var check_store_dom = $('.check-store-'+key_token);
        if($('#check-store-'+key_token).is(':checked')){
            check_store_dom.each(function (){
                $(this).prop('checked', true);
            });
        }else{
            check_store_dom.each(function (){
                $(this).prop('checked', false);
            });
        }
        
        select_to_checkout_items();
    }
    function select_to_checkout_items(){        
        $('#card-cart-listing').LoadingOverlay("show");
        var cart_key_tokens = [];
        $(document).find('.check-item').each(function (){
            if($(this).is(':checked')){
                if(typeof $(this).data('key_token') !== 'undefined') {
                    var key_token = $(this).data('key_token'); 
                    if(key_token != ''){
                        cart_key_tokens.push(key_token);
                    }
                }
            }
        });
        if(cart_key_tokens.length > 0){
            @this.call('checkout_items', cart_key_tokens)
        }else{
            @this.call('reset_checkout_items')
        }
    }
    function quantity_update(key_token, type='plus'){
        var is_continue = true;
        var new_value = $('#quantity-'+key_token).val();
        // var timeOutId = setTimeout(() => {
        //     $('#btn-quantity-minus-'+key_token).attr('disabled', true);
        //     $('#btn-quantity-plus-'+key_token).attr('disabled', true);
        //     // $('#quantity-'+key_token).attr('readonly', true);
        // }, 200);
        if(type == 'force'){
            setTimeout(() => {
                @this.call('quantity_update', key_token, new_value);
            }, 1000);
            
            is_continue = false;
        }
        
        if(is_continue){
            new_value = parseInt(new_value)
            if(type == 'plus'){
                new_value = new_value + 1;
            }else{
                new_value = new_value - 1;
                
                if(new_value <= 0){
                    delete_item(key_token);
                    is_continue = false;
                    // $('#btn-quantity-minus-'+key_token).removeAttr('disabled', true);
                    // $('#btn-quantity-plus-'+key_token).removeAttr('disabled', true);
                    // $('#quantity-'+key_token).removeAttr('readonly', true);
                    // clearTimeout(timeOutId);
                }
            }
            if(is_continue){
                @this.call('quantity_update', key_token, new_value);
            }
        }
    }
    function delete_item(key){
        Swal.fire({
            title: 'Are you sure do you want to delete this item?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Deleting Item...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('delete', key)
                    }
                });
            }
        })
    }
</script>
@endpush