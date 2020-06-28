$(window).on('scroll', function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".sticky").addClass("stickyadd");
    } else {
        $(".sticky").removeClass("stickyadd");
    }
});

$('.nav-item a, .scroll_down a').on('click', function (event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top - 0
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
});

$("#navbarCollapse").scrollspy({
    offset: 70
});

$('.video_play').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
});

$(window).on('scroll', function () {
    if ($(this).scrollTop() > 100) {
        $('.back_top').fadeIn();
    } else {
        $('.back_top').fadeOut();
    }
});


$('.back_top').on('click', function () {
    $("html, body").animate({
        scrollTop: 0
    }, 1000);
    return false;
});
