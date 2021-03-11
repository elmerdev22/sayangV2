<div>
    <div class="col-12">
        <ul id="glasscase" class="gc-start">
            @foreach([$featured_photo] as $photo)
                <li><img src="{{$photo}}" alt="Photo"/></li>
            @endforeach
            @foreach([$media_photos] as $photo)
                <li><img src="{{$photo}}" alt="Photo"/></li>
            @endforeach
        </ul>
    </div>
</div>
