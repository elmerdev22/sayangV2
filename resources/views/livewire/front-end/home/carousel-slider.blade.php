<div>
    <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
        <ol class="carousel-indicators">
            @forelse ($data as $key => $row)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' :''}}"></li>
            @empty
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
            @endforelse
        </ol>
        <div class="carousel-inner">
            @forelse ($data as $key => $row)
                <div class="carousel-item {{$key == 0 ? 'active' :''}}">
                    <img class="d-block w-100 lazy" src="{{UploadUtility::image_setting($row->id, 'home-carousel-slider', false)}}" alt="{{$row->settings_name}}">
                </div>
            @empty
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('images/default-photo/banner1.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('images/default-photo/banner2.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('images/default-photo/banner3.jpg')}}" alt="Third slide">
                </div>
            @endforelse
        </div>
    </div>
</div>
