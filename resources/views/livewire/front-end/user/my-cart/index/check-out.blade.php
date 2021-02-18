<div>
    <div class="card">
        <div class="card-body">
            <dl class="dlist-align">
                <dt>Total price:</dt>
                <dd class="text-right">{{Utility::currency_code()}}{{number_format($total_price, 2)}}</dd>
            </dl>
            <dl class="dlist-align">
                <dt>Discount:</dt>
                <dd class="text-right text-danger">- {{Utility::currency_code()}}{{number_format($discount, 2)}}</dd>
            </dl>
            <dl class="dlist-align">
                <dt>Total:</dt>
                <dd class="text-right text-dark b"><strong>{{Utility::currency_code()}}{{number_format($total, 2)}}</strong></dd>
            </dl>
            <hr>
            <p class="text-center mb-3">
                <img src="../images/misc/payments.png" height="26">
            </p>
            <a class="btn btn-primary btn-block"
                @if($is_disabled) 
                    onclick="no_item_alert()" 
                    href="javascript:void(0);" 
                @else 
                    {{-- onclick="proceed_checkout()"  --}}
                    href="{{route('front-end.user.check-out.index')}}" 
                @endif 
            > Make Purchase </a>
        </div> <!-- card-body.// -->
    </div> <!-- card.// -->
</div>
