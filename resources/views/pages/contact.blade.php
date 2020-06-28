@extends('layouts.test')
@section('title', 'Myhomeworkshark: Contact Myhomeworkshark')
@section('content')
<div class="dzsparallaxer auto-init" data-options='{   direction: "reverse"}' style="height: 350px;">
    <div class="divimage dzsparallaxer--target " style="width: 101%; height: 600px; background-image: url({{ asset('img/bg2.jpg') }})">
    </div>
    <div class=" parallax-text center-it page-title text-center">
        <h1 class="text-uppercase">Contact Us</h1>

    </div>
</div>
<!--end page header-->

<div class="container">
    <div class="space-90"></div>
    <div class='row'>
        <div class="col-lg-6 col-md-7 margin-b-40">
            <h3 class="margin-b-30">Feel free to contact us!</h3>

            <form method="post" action="contact.html#" class="saas-contact">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 margin-b-20">
                                <input type="text" name="name" class="form-control" placeholder="Full Name...." />
                            </div>
                            <div class="col-sm-12 margin-b-20">
                                <input type="text" name="email" class="form-control" placeholder="Email Address...." />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 margin-b-20">
                        <textarea name="message" class="form-control" rows="5" placeholder="Message...."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="data-status"></div> <!-- data submit status -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" name="submit" class="btn btn-primary btn-rounded">send message</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-lg-6 col-md-5 margin-b-40">
            <h4>Address</h4>
            <p class="margin-b-0">
                124, Munali, Niwaru Road,<br>
                Jaipur, Rajsthan, <br>
                US - 302012
            </p>
            <hr>
            <h4>Phone &amp; fax</h4>
            <p class="margin-b-0">
                +1 323 3150 316<br>
                +1 323 3150 316 <br>

            </p>
            <hr>
            <h4>Email &amp; support center</h4>
            <p class="margin-b-0">
                support@myhomeworkshark.com<br>
                admin@myhomeworkshark.com <br>

            </p>
        </div>
    </div>
    <div class='space-50'></div>
</div>
<!--Google Maps-->
<div class="google-map-container margin-b-60">
    <div id="googlemaps" style="width: 100%;height: 400px;"></div>
</div>
@stop

@section('scripts')
<!-- page scripts -->
<script src="{{ asset('js/contact.js') }}" type="text/javascript"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBENlIxSKmTEK2fJeKjKo_JMxC9jE2IkL4"></script>
<script src="{{ asset('js/jquery.gmaps.min.js') }}"></script>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {

            $('#googlemaps').gMap({
                maptype: 'ROADMAP',
                scrollwheel: false,
                zoom: 13,
                markers: [{
                    address: 'New York, 45 Park Avenue', // Your Adress Here
                    html: '<strong>Our Office</strong><br>45 Park Avenue, Apt. 303 </br>New York, NY 302012 ',
                    popup: false,
                    icon: {
                        image: "asset('img/marker.png') }}",
                        iconsize: [48, 48],
                        iconanchor: [48, 48]
                    }
                }]
            });
        });
    })(this.jQuery);

</script>
@stop
@section('content')
@stop
