<div>
    
    <h2 class="title">{{ucfirst($product_post->product->name)}}</h2>
    <div class="rating-wrap my-3">
        <small class="text-muted">{{ucfirst($product_post->product->partner->name)}}</small>
        <span class="badge badge-warning"> <i class="fa fa-star"></i>
            {{Utility::get_partner_ratings($product_post->product->partner->id)}}
        </span>
        @if($store_hours['is_set'])
            <div>
                <small class="text-muted">Store hours: {{$store_hours['open_time']}} - {{$store_hours['close_time']}} ({{$store_hours['status']}})</small>
            </div>
        @endif
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-3">		
            <figure class="item-feature">
                <var class="price h4">
                    @if(!$force_disabled)
                        {{number_format($product_post->quantity)}}
                    @endif
                </var> 
                @if(!$force_disabled)
                    <span class="text-muted">LEFT!</span> 
                @endif
            </figure> <!-- iconbox // -->
        </div><!-- col // -->
        <div class="col-4 col-md-3 pt-1 text-center">	
            <figure class="item-feature">
                <span class="text-primary"><i class="fa fa fa-seedling"></i></span> 
                <span>3</span>
            </figure> <!-- iconbox // -->
        </div><!-- col // -->
        <div class="col-4 col-md-3 pt-1 text-center">
            <figure  class="item-feature">
                <span class="text-info"><i class="fa fa fa-tint"></i></span>	
                <span>2</span>
            </figure> <!-- iconbox // -->
        </div><!-- col // -->
        <div class="col-4 col-md-3 pt-1 text-center">	
            <figure  class="item-feature">
                <span class="text-warning"><i class="fa fa fa-bolt"></i></span>
                <span>0.4</span>
            </figure> <!-- iconbox // -->
        </div> <!-- col // -->
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

    {{-- @if(!$force_disabled) --}}
    <dl class="row">
        <div class="col-md-6">
            <div class="row">
                <dt class="col-sm-4">Weight</dt>
                <dd class="col-sm-8">{{$product_post->product->weight ? $product_post->product->weight.' kilogram(s)' : 'Not set'}}</dd>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <dt class="col-sm-4">Shelf life</dt>
                <dd class="col-sm-8">{{$product_post->product->shelf_life ? $product_post->product->shelf_life.' month(s)' : 'Not set'}}</dd>
            </div>
        </div>
    </dl>
    <dl class="row">
        <div class="col-md-6">
            <div class="row">
                <dt class="col-sm-4">Length</dt>
                <dd class="col-sm-8">{{$product_post->product->length ? $product_post->product->length : 'Not set'}}</dd>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <dt class="col-sm-4">Width</dt>
                <dd class="col-sm-8">{{$product_post->product->width ? $product_post->product->width : 'Not set'}}</dd>
            </div>
        </div>
    </dl>
    <dl class="row">
        <div class="col-md-6">
            <div class="row">
                <dt class="col-sm-4">Height</dt>
                <dd class="col-sm-8">{{$product_post->product->height ? $product_post->product->height : 'Not set'}}</dd>
            </div>
        </div>
        @if($product_post->product->paper_packaging)
            <div class="col-md-6">
                <ul class="list-check mb-4">
                    <li>Paper packaging</li>
                </ul>
            </div>
        @endif
    </dl>
    {{-- @endif --}}
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