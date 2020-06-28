<footer class="footer">
    <div class="space-50"></div>
    <div class="container">
        <div class="row vertical-align-child">
            <div class="col-md-3 margin-b-30">
                <div class="margin-b-20">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/mshark.png') }}" height="42px" alt="" class="logo-default img-responsive">
                    </a>
                </div>
                <p>
                    Myhomeworkshark. Com is a fast growing company in the field of Academic Research writing
                </p>
            </div>
            <div class="col-md-3 margin-b-30">
                <ul class="list-unstyled">
                    <li><a href="/tos">Terms and conditions</a></li>
                    <li><a href="/privacy-policy">Privacy policy</a></li>
                    <li><a href="/revision-policy">Revision policy</a></li>
                </ul>
            </div>
            <div class="col-md-3 margin-b-30">
                <ul class="list-unstyled">
                    <li><a href="/plagiarism-free-guarantee">Plagiarism free guarantee</a></li>
                    <li><a href="/refund-policy">Refund policy</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3 margin-b-30">
                <ul class="list-inline social">
                    <li class="list-inline-item"><a href="/"><i class="ion-social-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="/"><i class="ion-social-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="/"><i class="ion-social-googleplus"></i></a></li>
                </ul>
                <h4>Subscribe to newsletter</h4>
                <form class="signup-form navbar-form margin-b-20">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter your email address">
                    </div>
                    <button type="submit" class="btn btn-cta btn-primary btn-lg">Subscribe</button>
                </form>
                <span>&copy; Copyright {{ date('Y') }}</span>
            </div>
        </div>
    </div>
</footer>