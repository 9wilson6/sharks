<!DOCTYPE html>
<html lang="en">
<head>    
    @include('includes.front.headlinks')    
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <!-- End Google Tag Manager (noscript) -->
    <div class="overlay"></div>    
    @yield('content')
    @include('includes.front.footer')
    <!-- Load Scripts Start -->
    @include('includes.front.footerlinks')
    @yield('calculatorhome')
</body>
</html>