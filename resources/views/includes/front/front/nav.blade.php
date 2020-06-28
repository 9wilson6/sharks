<nav class="navbar navbar-toggleable-md navbar-light fixed-top  navbar-transparent clearfix">
    <!-- Start Top Search -->
    <div class="top-search clearfix">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="ion-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="ion-android-close"></i></span>
            </div>
        </div>
    </div><!-- End Top Search -->
    <div class="clearfix"></div>
    <div class="container">


        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/mshark.png') }}" width="168px" height="42px" alt=""
                class="logo-default img-responsive">
            <img src="{{ asset('img/mshark.png') }}" width="84px" height="21px" alt=""
                class="logo-scroll img-responsive">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                <li class="nav-item"><a href="{{ url('/register') }}" class="btn btn-rounded btn-primary nav-link">Free
                        Signup</a></li>
            </ul>
        </div>
    </div>
</nav>
