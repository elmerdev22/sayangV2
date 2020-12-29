<div>
    <div class="row">
        <div class="col-lg-8">
            <h3 class="my-2">{{ucfirst($product_post->product->name)}}</h3>
        </div>
        
        <div class="col-lg-4">
            <h3 class="my-2 text-danger text-lg-right">
                @if(!$force_disabled)
                    {{number_format($product_post->quantity)}} LEFT!
                @endif
            </h3>
        </div>
    </div>

    <a href="{{route('front-end.profile.partner.index', ['slug' => $product_post->product->partner->slug ])}}">
        <p>{{ucfirst($product_post->product->partner->name)}}
            <span class="fas fa-star text-warning"></span>
            <small>({{Utility::get_partner_ratings($product_post->product->partner->id)}})</small>
        </p>
    </a>
    <p class="text-justify">{!! $product_post->product->description !!}</p>
    <div class="bg-danger p-2 w-50 text-center">
        <span class="fas fa-clock"></span> 
        <span class="countdown">
            @if($force_disabled)
                {{ucwords(Utility::product_post_status($product_post_id))}}
            @else
                {{$component->datetime_format($product_post->date_end)}}
            @endif
        </span>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    var event_channel = push_init.subscribe('product-post-update-channel');
    event_channel.bind('product-post-update-event', function(param) {
        @this.call('product_post_update_event', param)
    });

    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $('.countdown').countdown("start");
    });
    $('.countdown').countdown({
        end: function() {
            @this.call('force_disabled')
        }
    });
</script>
@endpush