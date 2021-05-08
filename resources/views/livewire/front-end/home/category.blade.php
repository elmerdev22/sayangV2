
<div>
    <div class="slider-items-owl owl-carousel owl-theme">
        @forelse($data as $catalog)
            <div class="item-slide">
                <figure class="item-logo">
                    <a href="{{route('front-end.product.list.index', ['category' => $catalog->slug])}}">
                        <img src="{{UploadUtility::category_photo($catalog->key_token)}}">
                        <figcaption class="pt-2 text-dark">{{ucfirst($catalog->name)}}</figcaption>
                    </a>
                </figure> <!-- item-logo.// -->
            </div>
        @empty
        @endforelse
    </div>
</div>

