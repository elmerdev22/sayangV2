<div>
    <div class="row">
        <div class="col-lg-8">
            <h3 class="my-2">{{ucfirst($product_post->product->name)}}</h3>
        </div>
        
        <div class="col-lg-4">
            <h3 class="my-2 text-danger float-right">{{number_format($product_post->quantity)}} LEFT!</h3>
        </div>
    </div>

    <a href="{{url('/profile/partner-name')}}">
        <p>{{ucfirst($product_post->product->partner->name)}} <span class="fas fa-star text-warning"></span> 4.5</p>
    </a>
    <p>{{nl2br($product_post->product->description)}}</p>
    <div class="bg-danger p-2 w-50 text-center">
        <span class="fas fa-clock"></span> <span id="countdown-timer" data-date_end="{{$component->datetime_format($product_post->date_end)}}">loading...</span>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        count_down_datetime();
    });

    function count_down_datetime(){
        var date_end   = $('#countdown-timer').data('date_end');
        var element_id = 'countdown-timer';
        count_down_timer(date_end, element_id);
    }
</script>
@endpush