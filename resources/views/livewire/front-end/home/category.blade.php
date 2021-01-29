
<div>
    <div class="row">
        <div class="col-12">    
            <div class="owl-carousel owl-theme">
                @forelse($data as $catalog)
                <div class="p-2">
                    <a href="{{route('front-end.product.list.index', ['category' => $catalog->slug])}}">
                        <img class="img-fluid img-circle shadow-sm" src="{{UploadUtility::category_photo($catalog->key_token)}}">
                        <small class="d-none d-lg-block pt-2 text-center font-weight-bold">
                            {{ucfirst($catalog->name)}}
                        </small>
                    </a>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>

