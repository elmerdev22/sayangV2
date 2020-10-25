<div>
    {{-- <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <input type="search" class="form-control" placeholder="Search Category ..." wire:model="search"> 
        </div>
    </div> --}}
    <div class="row">
        @forelse($data as $catalog)
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="font-weight-bold text-uppercase">
                    <img style="width: 40px;" class="card-img-top display-inline img-fluid img-circle shadow-sm border " src="{{UploadUtility::category_photo($catalog->key_token)}}" alt="Card image cap">
                    <a href="{{url('/products')}}">{{$catalog->name}}</a>
                </h6>
                <ul class="list-unstyled">
                    @foreach ($catalog->sub_category as $sub_category)
                        <li class="nav-item"><a href="{{url('/products')}}" class="nav-link text-small pb-0">{{ucwords($sub_category->name)}}</a></li> 
                    @endforeach
                </ul>
            </div>
        @empty
        @endforelse
    </div>
</div>
