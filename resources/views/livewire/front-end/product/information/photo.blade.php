<div>
    <div class="col-12">
        <ul id="glasscase" class="gc-start">
            @foreach($featured_photo as $photo)
                <li><img src="{{$photo->getFullUrl()}}" alt="Photo"/></li>
            @endforeach
            @foreach($media_photos as $photo)
                <li><img src="{{$photo->getFullUrl()}}" alt="Photo"/></li>
            @endforeach
        </ul>
    </div>
    @if($product->reminders)
        <div class="col-12">
            <h5 class="pt-3">Few Reminders</h5>
            <p>{!! $product->reminders !!}</p>
        </div>
    @endif
</div>
