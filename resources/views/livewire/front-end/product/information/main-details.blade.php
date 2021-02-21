<div>
    
    <h2 class="title">{{ucfirst($product_post->product->name)}}</h2>
    <div class="rating-wrap my-3">
        <small class="label-rating text-muted">{{ucfirst($product_post->product->partner->name)}}</small>
        <span class="badge badge-warning"> <i class="fa fa-star"></i>
            {{Utility::get_partner_ratings($product_post->product->partner->id)}}
        </span>
    </div>

    <div class="mb-3"> 
        <var class="price h4">
            @if(!$force_disabled)
                {{number_format($product_post->quantity)}}
            @endif
        </var> 
        @if(!$force_disabled)
            <span class="text-muted">LEFT!</span> 
        @endif
    </div> 
    <div class="row">
        <div class="col-sm-6">
            <div class="bg-primary mb-3 p-2 w-100 text-center text-white rounded">
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
    </div>

    <p>
        {!! $product_post->product->description !!}
    </p>

    @if(!$force_disabled)
        <dl class="row">
        <dt class="col-sm-3">Weight</dt>
        <dd class="col-sm-9">2.3 kilograms</dd>
        
        <dt class="col-sm-3">Condition</dt>
        <dd class="col-sm-9">Brandnew</dd>
        
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