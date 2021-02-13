
<div>
    <div class="slider-items-owl owl-carousel owl-theme">
        @forelse($data as $catalog)
            <div class="item-slide">
                <figure class="box item-logo">
                    <a href="{{route('front-end.product.list.index', ['category' => $catalog->slug])}}">
                        <img src="{{UploadUtility::category_photo($catalog->key_token)}}">
                    </a>
                    <figcaption class=" pt-2">{{ucfirst($catalog->name)}}</figcaption>
                </figure> <!-- item-logo.// -->
            </div>
        @empty
        @endforelse
    </div>
</div>

