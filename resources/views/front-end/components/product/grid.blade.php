<div class="card card-product-grid">
    <a href="{{$buy_now}}" class="img-wrap"> 
        <img src="{{$featured}}">
        <span class="topbar">
            <span class="badge p-2 float-right" style="position: static; color:white; background-color: #cfcfcf">
                <span class="fa fa-clock"></span>
                <span class="countdown">{{$countdown}}</span>
            </span>
            <span class="badge badge-danger p-2" style="position: static">
                {{$discount_percentage}}% OFF
            </span>
        </span>
    </a>
    <figcaption class="info-wrap">
        <div class="mt-2">
            <div class="row">
                <div class="col-7 text-truncate"><var class="title">{{$product_name}}</var></div>
                <div class="col-5"><span class="float-right text-ellipsis">{{$quantity_left}} LEFT</span></div>
            </div>
        </div> <!-- action-wrap.end -->
        <div class="mt-2">
            <div></div>
            <var class="price">{{$buy_now_price}} <small><del>{{$regular_price}}</small></del></var> <!-- price-wrap.// -->
            <a href="{{$buy_now}}" class="btn btn-sm btn-primary float-right" style="width: 70px;">Buy now</a>
        </div> <!-- action-wrap.end -->
        <div class="mt-2">
            @if($bid_details_top != 'None')
                <var class="price">{{$bid_details_top_price}} 
            @endif
            <small>Bids: {{$bid_details_count}}</small></var> <!-- price-wrap.// -->
            <a href="{{$bid_now}}" class="btn btn-sm btn-light float-right" style="width: 70px;">Bid now</a>
        </div> <!-- action-wrap.end -->
        <div class="mt-3 elements-section">
            <div class="row text-center">
                <div class="col-4 text-truncate">
                    <span class="text-primary">
                        <i class="fa fa-seedling"></i>
                    </span>
                    <small>{{$elements_trees}}</small>
                </div>
                <div class="col-4 text-truncate">
                    <span class="text-info">
                        <i class="fa fa-tint"></i>
                    </span>
                    <small class="text-truncate">{{$elements_water}}</small>
                </div>
                <div class="col-4 text-truncate">
                    <span class="text-warning">
                        <i class="fa fa-bolt"></i>
                    </span>
                    <small class="text-truncate">{{$elements_energy}}</small>
                </div>
            </div>
        </div> <!-- action-wrap.end -->
    </figcaption>
</div>