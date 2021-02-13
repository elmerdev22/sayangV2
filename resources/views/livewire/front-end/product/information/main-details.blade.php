<div>
    
    <h2 class="title">{{ucfirst($product_post->product->name)}}</h2>
    <div class="rating-wrap my-3">
        <small class="label-rating text-muted">{{ucfirst($product_post->product->partner->name)}}</small>
        <span class="badge badge-warning"> <i class="fa fa-star"></i>
            {{Utility::get_partner_ratings($product_post->product->partner->id)}}
        </span>
        <small class="label-rating text-muted">132 reviews</small>
    </div>

    <div class="mb-3"> 
        <var class="price h4">
            @if(!$force_disabled)
                {{number_format($product_post->quantity)}} LEFT!
            @endif
        </var> 
        @if(!$force_disabled)
            <span class="text-muted">Left</span> 
        @endif
    </div> 
    
    <div class="bg-primary mb-3 p-2 w-50 text-center text-white rounded">
        <span class="fas fa-clock"></span> 
        <span class="countdown">
            @if($force_disabled)
                {{ucwords(Utility::product_post_status($product_post_id))}}
            @else
                {{$component->datetime_format($product_post->date_end)}}
            @endif
        </span>
    </div>

    <p>
        {!! $product_post->product->description !!}
    </p>

    @if(!$force_disabled)
        <dl class="row">
        <dt class="col-sm-3">Model#</dt>
        <dd class="col-sm-9">Odsy-1000</dd>
        
        <dt class="col-sm-3">Color</dt>
        <dd class="col-sm-9">Brown</dd>
        
        <dt class="col-sm-3">Delivery</dt>
            <dd class="col-sm-9">Russia, USA, and Europe </dd>
        </dl>
    @endif
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