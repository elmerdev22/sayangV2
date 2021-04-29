<div>
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-3">Overview</h4>
            <dl class="dlist-align">
                <dt class="text-muted">Total Price:</dt>
                <dd>{{Utility::currency_code()}}{{number_format($total_price, 2)}}</dd>
            </dl>
            <dl class="dlist-align">
                <dt class="text-muted">Discount:</dt>
                <dd class="text-danger">- {{Utility::currency_code()}}{{number_format($discount, 2)}}</dd>
            </dl>
            <hr>
            <dl class="dlist-align">
                <dt>Total:</dt>
                <dd class="h5"><strong>{{Utility::currency_code()}}{{number_format($total, 2)}}</strong></dd>
            </dl>
            <hr>
            <a href="{{route('front-end.user.my-cart.index')}}" class="btn btn-primary btn-block"> Back to My Cart  </a>
        </div> <!-- card-body.// -->
    </div> <!-- card.// -->
</div>
