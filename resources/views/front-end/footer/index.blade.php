<div class="container pb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-md-row flex-column align-items-center">
                <div class="px-2 d-none d-md-block"><img src="{{UploadUtility::content_photo('logo')}}" height="45" class="d-inline-block align-top" alt=""></div>
                <div class="px-2"><a href="{{route('front-end.about-us.index')}}">About Us</a></div>
                <div class="px-2"><a href="{{route('front-end.help-centre.index')}}">Help Centre</a></div>
                <div class="px-2"><a href="{{route('front-end.terms-and-conditions.index')}}">Terms & Conditions</a></div>
                <div class="d-block d-md-none w-100 text-center">
                    <hr>
                    <img src="{{UploadUtility::content_photo('logo')}}" height="45" class="d-inline-block align-top" alt="">
                </div>
                <div class="px-2 footer-right ml-auto">
                    © {{date('Y')}} All Rights Reserved by <a href="#">{{env('APP_NAME')}}</a>                
                </div>
            </div>
        </div>
    </div>
</div>