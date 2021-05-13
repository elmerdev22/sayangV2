<footer class="section-footer border-top">
    <div class="container">
        <section class="footer-top padding-y">
            <div class="row">
                <aside class="col-md col-12">
                    <h6 class="title">{{ Utility::settings('app_name') }}</h6>
                    <ul class="list-unstyled">
                        <li> <a href="{{route('front-end.about-us.index')}}">About us</a></li>
                        <li> <a href="{{route('front-end.privacy-policy.index')}}">Privacy Policy</a></li>
                        <li> <a href="{{route('front-end.terms-and-conditions.index')}}">Terms & Condition (Partner)</a></li>
                        <li> <a href="{{route('front-end.terms-and-conditions.partners')}}">Terms & Condition (User)</a></li>
                    </ul>
                </aside>
                <aside class="col-md col-12">
                    <h6 class="title">Account</h6>
                    <ul class="list-unstyled">
                        <li> <a href="{{url('/login')}}"> User Login </a></li>
                        <li> <a href="{{url('/register')}}"> User register </a></li>
                        <li> <a href="{{route('partner.login')}}"> Partner Login </a></li>
                        <li> <a href="{{route('partner.register')}}"> Partner register </a></li>
                    </ul>
                </aside>
                <aside class="col-md col-12">
                    <h6 class="title">Social</h6>
                    <ul class="list-unstyled">
                        @foreach (Utility::social_media_settings() as $row)
                            <li><a href="{{$row->url}}"> <i class="{{$row->icon}}"></i> {{ucfirst($row->name)}} </a></li>
                        @endforeach
                    </ul>
                </aside>
                <aside class="col-md col-12">
                    <h6 class="title">Help</h6>
                    <ul class="list-unstyled">
                        <li> <a href="{{route('front-end.help-centre.index')}}">Help Centre</a></li>
                        <li> <a href="#">Contact Us</a></li>
                    </ul>
                </aside>
            </div> <!-- row.// -->
        </section>	<!-- footer-top.// -->

        <section class="footer-bottom border-top row">
            <div class="col-md-2 text-center text-md-left">
                <p class="text-muted"> &copy {{date('Y')}} {{env('APP_NAME')}} </p>
            </div>
            <div class="col-md-8 text-md-center">
            </div>
            <div class="col-md-2 text-center text-md-left text-muted">
                <i class="fab fa-lg fa-cc-visa"></i>
                <i class="fab fa-lg fa-cc-mastercard"></i>
                <i class="fab fa-lg fa-cc-amex"></i>
            </div>
        </section>
    </div><!-- //container -->
</footer>