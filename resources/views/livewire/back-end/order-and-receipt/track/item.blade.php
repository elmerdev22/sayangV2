<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td width="60">
                            <img style="height: 50px; width: auto;" 
                                src="{{$component->featured_photo($row->product_post->product->partner->user_account->key_token, $row->product_post->product->key_token)}}" 
                                class="img-sm border">
                        </td>
                        <td> 
                            <p class="title mb-0">{{ucfirst($row->product_post->product->name)}}</p>
                            <small class="price text-muted">₱ {{number_format($row->price, 2)}} x {{$row->quantity}}</small>
                        </td>
                        <td> 
                            ₱ {{number_format($row->price * $row->quantity, 2)}} 
                        </td>
                        <td> 
                            <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_post->product->slug, 'key_token' => $row->product_post->key_token, 'type' => 'buy_now'])}}" class="btn btn-warning btn-sm float-right">Details</a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- table-responsive .end// -->
</div>
