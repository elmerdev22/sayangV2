<div>
    <table class="table table-borderless table-hover table-shopping-cart">
        <thead>
            <tr class="border-bottom">
                <th scope="col" width="10" class="text-center">
                    <span class="icheck-warning">
                        <input type="checkbox" id="check_all">
                        <label for="check_all"></label>
                    </span>
                </th>
                <th scope="col">PRODUCTS</th>
                <th scope="col" width="100">QUANTITY</th>
                <th scope="col" width="130">PRICE</th>
                <th scope="col" class="text-right" width="50">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $row)
                <tr class="border">
                    <td colspan="1">
                        <span class="icheck-warning">
                            <input type="checkbox" id="check_store-{{$key}}">
                            <label for="check_store-{{$key}}"></label>
                        </span>
                    </td>
                    <td colspan="4">
                        <span class="fas fa-store"></span> {{strtoupper($row['partner_name'])}}
                    </td>
                </tr>
                @foreach($row['products'] as $product_key => $product_row)
                    <tr>
                        <td class="text-center">
                            <span class="icheck-warning">
                                <input type="checkbox" id="check-{{$product_row['cart_key_token']}}" @if($product_row['is_expired']) disabled @endif>
                                <label for="check-{{$product_row['cart_key_token']}}"></label>
                            </span>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-2 overflow-hidden">
                                    <img src="{{$product_row['featured_photo']}}" class="img-sm border cart-product-photo-thumb">
                                </div>
                                <div class="col-md-10 text-left">
                                    <p class="title mb-0">Product name goes here </p>
                                    <small class="bg-danger p-1"> 
                                        <span class="fas fa-clock"></span> 
                                        @if($product_row['is_expired'])
                                            <span>Expired</span> 
                                        @else
                                            <span class="countdown-timer" id="countdown-timer-{{$product_row['cart_key_token']}}" data-date_end="{{$product_row['date_end']}}">loading...</span> 
                                        @endif
                                    </small> 
                                </div>
                            </div>
                        </td>
                        <td> 
                            <select class="form-control form-control-sm" width="20" @if($product_row['is_expired']) disabled @endif>
                                @if($product_row['current_quantity'] > 0 && $product_row['is_expired'] == false)
                                    @for($x=0; $x <= $product_row['current_quantity']; $x++)
                                        <option @if($x == $product_row['selected_quantity']) selected @endif value="{{$x}}">{{$x}}</option>
                                    @endfor
                                @else
                                    <option selected value="{{$product_row['selected_quantity']}}">{{$product_row['selected_quantity']}}</option>
                                @endif
                            </select>
                            <span>
                                <small class="text-muted"> {{$product_row['current_quantity']}} LEFT </small> 
                            </span>
                        </td>
                        <td>
                            <div class="price-wrap"> 
                                <div class="price">₱ {{number_format($product_row['total_price'], 2)}}</div> 
                                <small class="text-muted"> ₱ {{number_format($product_row['buy_now_price'], 2)}} each </small> 
                            </div> <!-- price-wrap .// -->
                        </td>
                        <td class="text-right"> 
                            <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" onclick="delete_item('{{$product_row['cart_key_token']}}')"> <span class="fas fa-trash"></span></a> 
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="5" class="text-center">No item found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        count_down_datetime();
    });

    function count_down_datetime(){
        $('.countdown-timer').each(function () {
            var date_end   = $(this).data('date_end');
            var element_id = $(this).attr('id');

            count_down_timer(date_end, element_id);
        });
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