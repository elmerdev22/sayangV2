<div>
    {{-- <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <input type="search" class="form-control" placeholder="Search Category ..." wire:model="search"> 
        </div>
    </div> --}}
    @if ($type == 'web')
        <div class="row">
            @forelse($data as $catalog)
                <div class="col-lg-3 col-md-6 mb-4 border-right border-left position-static">
                    <img class="img-sm img-circle shadow-sm " src="{{UploadUtility::category_photo($catalog->key_token)}}" alt="Card image cap">
                    <a class="p-2" href="{{route('front-end.product.list.index', ['category' => $catalog->slug])}}">{{ucfirst($catalog->name)}}</a>
                    <ul class="list-unstyled pl-4">
                        @foreach($catalog->sub_categories as $sub_category)
                            <li class="nav-item"><a href="{{route('front-end.product.list.index', ['category' => $catalog->slug , 'sub_category' => $sub_category->slug])}}" class="nav-link text-small pb-0">{{ucfirst($sub_category->name)}}</a></li> 
                        @endforeach
                    </ul>
                </div>
            @empty
            @endforelse
        </div>
    @else 
    <div id="MainMenuCategory">
        <div class="list-group panel rounded-0">
            
            @forelse($data as $catalog)
                <a href="#catalog-{{$catalog->id}}" class="list-group-item rounded-0" data-toggle="collapse" data-parent="#MainMenuCategory">
                    <img style="width: 25px;" class="card-img-top display-inline img-fluid img-circle shadow-sm border " src="{{UploadUtility::category_photo($catalog->key_token)}}" alt="Card image cap"> {{ucfirst($catalog->name)}}
                    
                    @if ($catalog->sub_categories->count() > 0)
                        <i class="fa fa-chevron-left float-right"></i>  
                    @endif
                </a>
                @if ($catalog->sub_categories->count() > 0)
                    <div class="collapse mb-1 rounded-0" id="catalog-{{$catalog->id}}">
                        @foreach($catalog->sub_categories as $sub_category)
                            <a href="#" class="list-group-item rounded-0">
                                <span class="far fa-circle mr-1 ml-2"></span> 
                                {{ucfirst($sub_category->name)}}
                            </a>
                        @endforeach
                    </div>
                @endif
            @empty
            @endforelse
        </div>
    </div>
    @endif
</div>
