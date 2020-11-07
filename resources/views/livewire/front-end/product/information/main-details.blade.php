<div>
    <div class="row">
        <div class="col-lg-8">
            <h3 class="my-2">{{ucfirst($product_post->product->name)}}</h3>
        </div>
        
        <div class="col-lg-4">
            <h3 class="my-2 text-danger float-right">
                @if($force_disabled)
                    Not Available
                @else
                    {{number_format($product_post->quantity)}} LEFT!
                @endif
            </h3>
        </div>
    </div>

    <a href="{{route('front-end.profile.partner.index', ['slug' => $product_post->product->partner->slug ])}}">
        <p>{{ucfirst($product_post->product->partner->name)}}
            <span class="fas fa-star text-warning"></span>
            <small>(4.5)</small>
        </p>
    </a>
    <p>{{nl2br($product_post->product->description)}}</p>
    <div class="bg-danger p-2 w-50 text-center">
        <span class="fas fa-clock"></span> 
        <span class="countdown">
            @if($force_disabled)
                Ended
            @else
                {{$component->datetime_format($product_post->date_end)}}
            @endif
        </span>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
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