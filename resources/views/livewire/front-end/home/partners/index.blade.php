<div>
    <header class="border-bottom mb-4 pb-2">
        <div class="form-inline">
            <span class="mr-md-auto my-1">{{number_format($data->total(), 0)}} Partner{{$data->total() > 1 ? 's':''}} found </span>
            
            <div class="input-group my-1 mr-2">
                <input type="search" class="form-control" id="search" placeholder="Search">
                <div class="input-group-prepend">
                    <button class="btn btn-primary rounded-right" onclick="search()">
                        <span class="fas fa-search"></span>
                    </button>
                </div>
            </div>
        </div>
    </header><!-- sect-heading -->
    
    <div class="row">
        @forelse($data as $partner)
            @php
                $photo = UploadUtility::account_photo($partner->user_key_token , 'business-information/store-photo', 'store_photo');
            @endphp
            <div class="col-md-4">
                @component('front-end.components.partners.grid')
                    @slot('link', route('front-end.profile.partner.index', ['slug' => $partner->slug ]))
                    @slot('photo', $photo)
                    @slot('name', ucfirst($partner->name))
                    @slot('ratings', Utility::get_partner_ratings($partner->id))
                    @slot('products', number_format(Utility::count_products($partner->id) ,0))
                @endcomponent
            </div>
        @empty
            <div class="col-12 text-center">
                <img style="width: 30%" src="{{asset('images/default-photo/no-search.jpg')}}">
                <h5 class="text-center font-weight-light">No Partner(s) Found</h5>
            </div>
        @endforelse   
    </div> <!-- row.// -->
    
    <div class="row justify-content-center">
        @if ($data->total() > 6 && $data->total() > $limit)
            <div class="col-12 mb-3 text-center">
                <button wire:click="load_more" class="btn btn-primary" style="width: 200px;">Load More <span class="" wire:loading.class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></button>
            </div>
        @endif
    </div>
</div>
@push('scripts')
<script>
    
    $("#search").keyup(function(event) {
        if (event.keyCode === 13) {
            search();
        }
    });
    
    function search(){
        var search = $('#search').val();
        @this.set('search', search)
    }
    
    // window.livewire.hook('beforeDomUpdate', () => {
    //     $.LoadingOverlay("show");
    // });
    
    // window.livewire.hook('afterDomUpdate', () => {
    //     $.LoadingOverlay("hide");
    // });
</script>
@endpush
