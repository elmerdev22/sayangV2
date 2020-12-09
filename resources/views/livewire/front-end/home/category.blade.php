<div>
    <div class="row">
        <div class="col-12">    
            <div class="owl-carousel owl-theme">
                    
                @forelse($data as $catalog)
                    <div class="item shadow-sm">
                        <div class="card text-center shadow-none" style="width: auto;">
                            <div class="card-body category-icon">
                                <img class="card-img-top display-inline img-fluid img-circle shadow-sm border " src="{{UploadUtility::category_photo($catalog->key_token)}}" alt="Card image cap">
                            </div>
                            <span class="mb-2 d-none d-lg-block ">
                                {{$catalog->name}}
                            </span>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
