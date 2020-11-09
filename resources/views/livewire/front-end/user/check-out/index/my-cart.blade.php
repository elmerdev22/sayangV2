<div>
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span>
            <i class="fas fa-shopping-cart"></i> Selected Items on Cart
            <span class="badge badge-warning badge-pill">{{number_format($total_quantity_items, 0)}}</span>
        </span>
    </h4>
    <ul class="list-group mb-3">
        @foreach($data as $row)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">{{ucfirst($row['name'])}}</h6>
                    <small class="text-muted">₱ {{number_format($row['buy_now_price'], 2)}} x {{number_format($row['selected_quantity'],0)}}</small>
                </div>
                <span>₱ {{number_format($row['total_price'], 2)}}</span>
            </li>
        @endforeach
        
        {{-- <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-dark">
                <h6 class="my-0">Voucher code</h6>
                <small>EXAMPLECODE</small>
            </div>
            <span class="text-dark">-₱ 50</span>
        </li> --}}
        <li class="list-group-item d-flex justify-content-between">
            <span>TOTAL (PHP)</span>
            <strong>₱ {{number_format($total_price, 2)}}</strong>
        </li>
    </ul>
</div>
