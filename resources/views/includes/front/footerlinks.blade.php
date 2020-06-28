<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/apphome.js') }}"></script>
@yield('scripts')
<script>
    var $ = $.noConflict();
$(function () {
    "use strict";
    if ($(".navbar").width() > 1007) {
        $('.navbar .dropdown').hover(function () {
            $(this).addClass('open');
        }, function () {
            $(this).removeClass('open');
        });
    }

    $(".search-nav a,.close-search").on("click", function () {
        $(".top-search").hide();
    });
    $(".search-nav a").on("click", function () {
        $(".top-search").show();
    });
    //back to top
    //Check to see if the window is top if not then display button
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').on("click", function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
    //animated scroll menu
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll > 0) {
            $('.navbar-transparent').addClass('shrink');
        }
        if (scroll <= 0) {
            $('.navbar-transparent').removeClass('shrink');
        }
    });
});
</script>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107833194-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-107833194-1');
</script>
