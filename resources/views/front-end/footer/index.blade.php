<footer class="section-footer border-top">
    <div class="container">
        <section class="footer-top padding-y">
            <div class="row">
                <aside class="col-md col-12">
                    <h6 class="title">{{ Utility::settings('app_name') }}</h6>
                    <ul class="list-unstyled">
                        <li> <a href="#">About us</a></li>
                        <li> <a href="#">Terms & Condition (Partner)</a></li>
                        <li> <a href="#">Terms & Condition (User)</a></li>
                    </ul>
                </aside>
                <aside class="col-md col-12">
                    <h6 class="title">Account</h6>
                    <ul class="list-unstyled">
                        <li> <a href="#"> User Login </a></li>
                        <li> <a href="#"> User register </a></li>
                        <li> <a href="#"> Partner Login </a></li>
                        <li> <a href="#"> Partner register </a></li>
                    </ul>
                </aside>
                <aside class="col-md col-12">
                    <h6 class="title">Social</h6>
                    <ul class="list-unstyled">
                        <li><a href="#"> <i class="fab fa-facebook"></i> Facebook </a></li>
                        <li><a href="#"> <i class="fab fa-twitter"></i> Twitter </a></li>
                        <li><a href="#"> <i class="fab fa-instagram"></i> Instagram </a></li>
                        <li><a href="#"> <i class="fab fa-youtube"></i> Youtube </a></li>
                    </ul>
                </aside>
                <aside class="col-md col-12">
                    <h6 class="title">Help</h6>
                    <ul class="list-unstyled">
                        <li> <a href="#">Help Centre</a></li>
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