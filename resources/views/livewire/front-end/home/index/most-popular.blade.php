<div>
    <div class="row">
        @foreach($data as $row)
            <div class="col-12 col-md-4 col-lg-3">
                <div class="card card-product-grid" >
                    <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}" class="img-wrap"> 
                        <img src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}">
                        <span class="topbar">
                            <span class="badge badge-primary p-2" style="position: static">
                                <span class="fa fa-clock"></span>
                                <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                            </span>
                            <span class="badge badge-danger p-2 float-right" style="position: static">
                                {{Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent']}}% OFF
                            </span>
                        </span>
                    </a>
                    <figcaption class="info-wrap">
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-7 text-truncate"><var class="title">{{ucfirst($row->product_name)}}</var></div>
                                <div class="col-5"><span class="float-right text-ellipsis">{{number_format($row->quantity, 0)}} LEFT</span></div>
                            </div>
                        </div> <!-- action-wrap.end -->
                        <div class="mt-2">
                            <div></div>
                            <var class="price">{{Utility::currency_code()}}{{number_format($row->buy_now_price, 2)}} <small><del>{{Utility::currency_code()}}{{number_format($row->regular_price, 2)}}</small></del></var> <!-- price-wrap.// -->
                            <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}" class="btn btn-sm btn-primary float-right" style="width: 70px;">Buy now</a>
                        </div> <!-- action-wrap.end -->
                        <div class="mt-2">
                            @if(Utility::bid_details($row->id, 'top') != 'None')
                                <var class="price">{{Utility::currency_code()}}{{Utility::bid_details($row->id, 'top')}} 
                            @endif
                            <small>Bids: {{Utility::bid_details($row->id, 'count')}}</small></var> <!-- price-wrap.// -->
                            <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid'])}}" class="btn btn-sm btn-light float-right" style="width: 70px;">Bid now</a>
                        </div> <!-- action-wrap.end -->
                        <div class="mt-3">
                            <div class="row text-center">
                                <div class="col-4">
                                    <span class="text-primary">
                                        <i class="fa fa-seedling"></i>
                                    </span>
                                    <small>0.5</small>
                                </div>
                                <div class="col-4">
                                    <span class="text-info">
                                        <i class="fa fa-tint"></i>
                                    </span>
                                    <small>2.3</small>
                                </div>
                                <div class="col-4">
                                    <span class="text-warning">
                                        <i class="fa fa-bolt"></i>
                                    </span>
                                    <small>4</small>
                                </div>
                            </div>
                        </div> <!-- action-wrap.end -->
                    </figcaption>
                </div>
            </div> <!-- col.// -->
        @endforeach
    </div> <!-- row.// -->
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
            @this.call('render')
        }
    });
</script>
@endpush