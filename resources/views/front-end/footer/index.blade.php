{{-- <footer class="">
  <div class="container pb-5">
        <div class="row">
            <div class="col-md-2 d-flex align-items-end">
                <input type="image" loading="lazy" src="{{asset('images/logo/logo.png')}}" class="img-fluid" alt="Bentaco Logo" style="height:40px;">
            </div>
            <div class="col-md-10 d-flex align-items-end">
                <a class="nav-link pb-0 mb-2 " href="{{route('front-end.about-us.index')}}">About Us</a>
                <a class="nav-link pb-0 mb-2 " href="{{route('front-end.help-centre.index')}}">Help Centre</a>
                <a class="nav-link pb-0 mb-2 " href="">Terms & Conditions</a>
                <a class="nav-link pb-0 mb-2 " href="">Privacy Policy</a>
            </div>
        </div>
        <hr>
        <div class="row pt-2">
            <div class="col-md-8">
                <small class="text-muted"><i class="far fa-copyright"></i> Copyright © {{date('Y')}} All Rights Reserved by <a href="/">{{env('APP_NAME')}}</a> </small>
            </div>
            <div class="col-md-4 text-sm-left text-md-center text-right ">
                <small class="text-muted">{{env('APP_NAME')}} {{date('Y')}} | Version {{env('APP_VERSION', 'not_set_in_ENV')}}</small>
            </div>
        </div>
  </div>
</footer> --}}
<div class="container pb-3">
    <div class="row">
        <div class="col-12 text-center">
            <p>Copyright © {{date('Y')}} All Rights Reserved by <a href="/">{{env('APP_NAME')}}</a></p>
        </div>
    </div>
</div>