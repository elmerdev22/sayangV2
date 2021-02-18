<div>
    <div class="row">
        @foreach($data as $row)
            <div class="col-md-6">
                <figure class="itemside  mb-4">
                    <div class="aside"><img src="{{$this->product_featured_photo($row['product_id'])[0]->getFullUrl('thumb')}}" class="border img-sm"></div>
                    <figcaption class="info">
                        <p>{{ucfirst($row['name'])}}</p>
                        <span class="text-muted">{{Utility::currency_code()}}{{number_format($row['buy_now_price'], 2)}} x {{number_format($row['selected_quantity'],0)}}</span>
                        <p class="text-muted">Subotal: {{Utility::currency_code()}}{{number_format($row['buy_now_price'] * $row['selected_quantity'], 2)}} </p>
                    </figcaption>
                </figure>
            </div> <!-- col.// -->
        @endforeach
    </div> <!-- row.// -->
</div>
