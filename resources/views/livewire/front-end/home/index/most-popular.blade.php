<div>
    <div class="row">
        <div class="col-12 mb-3">
        <h3 class="title" data-aos="fade-right">MOST POPULAR</h3>
        </div>
        @foreach($data as $row)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up">
            <div class="card mb-4 product-card">
                <div style="width:100%; text-align:center">
                <img class="card-img-top sayang-card-img-listing" src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}" alt="Card image cap">
                <span class="ends-in">
                    <div class="countdown text-white">
                        <span class="fas fa-clock"></span>
                        <span class="countdown-timer" id="countdown-timer-{{$row->key_token}}" data-date_end="{{$component->datetime_format($row->date_end)}}">loading...</span>
                    </div>
                </span>
                <div class="store-info p-1 mx-1 bg-transparent" style="margin-top: -30px;">
                    <div class="row">
                        <div class="col-9 text-white text-left text-ellipsis">
                            {{ucfirst($row->partner_name)}}
                        </div>
                        <div class="col-3 text-right">
                            <span class="fas fa-star text-warning"></span> 
                            <span class="text-white">4.5</span>
                        </div>
                    </div>
                </div>
                <div class="product-info p-2">
                    <div class="row">
                        <div class="col-8 font-weight-bold text-left text-ellipsis">
                            {{ucfirst($row->product_name)}}
                        </div>
                        <div class="col-4 text-right">
                            {{number_format($row->quantity)}} left
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0">
                    <div class="col-md-6 m-0 p-0">
                        <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}">
                            <button class="btn btn-sm btn-dark item-btn">
                            <span class="font-weight-bold">Buy Now</span><br>
                            <small class="text-white item-info">Php: {{number_format($row->buy_now_price, 2)}}</small>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6 m-0 p-0">
                        <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid'])}}">
                            <button class="btn btn-sm btn-outline-warning text-dark item-btn">
                            <span class="font-weight-bold">Place Bid</span><br>
                            <small class="item-info">Bids: 5 | Top: 250.00</small>
                            </button>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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
</script>
@endpush