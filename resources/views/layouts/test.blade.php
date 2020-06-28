<!DOCTYPE html>
<html lang="en">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700|Open+Sans:300,300i,400,400i,600,700");
        @font-face {
        font-family: "Ionicons";
        src: url("{{ asset('fonts/ionicons.eot') }}?v=2.0.0");
        src: url("{{ asset('fonts/ionicons.eot') }}?v=2.0.0#iefix") format("embedded-opentype"), url("{{ asset('fonts/ionicons.ttf') }}?v=2.0.0") format("truetype"), url("{{ asset('fonts/ionicons.woff') }}?v=2.0.0") format("woff"), url("{{ asset('fonts/ionicons.svg') }}?v=2.0.0#Ionicons") format("svg");
        font-weight: normal;
        font-style: normal; }
        .navbar-light.navbar-transparent.shrink {
            background-color: #fff;
            padding: 0.6rem 0 !important;
        }

        .orderformhome{
            /*background-color: #1b4d6e;*/
            background-color: rgba(76, 84, 129, 0.79);
            padding: 15px;
            border-radius: 5px;
            border-color: black;
        }
        .lablesd {
            text-decoration: bold;
            font-size: 16px;
            color: white;
            font-weight: bold;
        }
        @media (min-width: 481px) and (max-width: 767px) {
            .leftcta {
                display: none;
            }

            .orderformhome{
                margin-top: 150px;
            }

            .navbar-light.navbar-transparent.shrink {
                background-color: #fff;
                padding: 1rem 0 !important;
            }
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .leftcta {
                display: none;
            }
            .orderformhome{
                margin-top: 150px;
            }
            .navbar-light.navbar-transparent.shrink {
                background-color: #fff;
                padding: 1rem 0 !important;
            }
        }
    </style>
    @include('includes.front.headlinks')
    <script>
	    window.myhomeworkShark = {!! json_encode([
	        'csrfToken' => csrf_token(),
	    ]) !!};
    </script>    
    <body>
        <!-- Static navbar -->
        @include('includes.front.nav')
        <!--navbar end-->
          @yield('content')        
        @include('includes.front.footer')
        <!-- jQuery plugins-->
        @include('includes.front.footerlinks')
    </body>
</html>