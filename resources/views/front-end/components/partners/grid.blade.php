
<a href="{{$link}}" class="card card-product-grid">
    <div class="img-wrap p-5">
        <img src="{{$photo}}">
    </div>
    <div class="info-wrap text-center ">
        <p class="title text-truncate">
            {{$name}}
            @if($ratings)
                <small> <i class="fa fa-star text-warning"></i>{{$ratings}}</small>
            @endif
        </p>
        <div><small>Products: {{$products}}</small></div>
    </div>
</a> <!-- card // -->