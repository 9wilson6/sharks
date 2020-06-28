$(document).ready(function () {
    $(".preloader").fadeOut();
    var $top = $("header");
    $(window).scroll(function () {
        if ($('body, html').attr('style') != "height: 100%;overflow: hidden;width: 100%;position: fixed;") {
            if ($('body, html').attr('class') != "body_n-scroll") {
                if ($(this).scrollTop() > 100 && $top.hasClass("default")) {
                    $top.fadeOut(1, function () {
                        $(this).removeClass("default").addClass("fixed").fadeIn(0);
                    });
                } else if ($(this).scrollTop() <= 100 && $top.hasClass("fixed")) {
                    $top.fadeOut(1, function () {
                        $(this).removeClass("fixed").addClass("default").fadeIn(0);
                    });
                }
            }
        }
    });
    $('a.link-faq').on('click', function (e) {
        e.preventDefault();
    })
    $(document).ready(function () {
        $('input,textarea').focus(function () {
            $(this).data('placeholder', $(this).attr('placeholder'))
            $(this).attr('placeholder', '');
        });
        $('input,textarea').blur(function () {
            $(this).attr('placeholder', $(this).data('placeholder'));
        });
    });
    $('.number-spinner button').click(function (e) {
        e.preventDefault();
        var inputCount = $(this).parent('.number-spinner').find('input');
        var count = parseInt(inputCount.val());
        if ($(this).hasClass('plus')) {
            count++;
        } else if ($(this).hasClass('minus') && count > 1) {
            count--;
        }
        inputCount.val(count);
        inputCount.change();
    });
    $(".set").on("click", function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass("active");
            $(this).children('.content-in').slideUp(200);
        } else {
            $(".set").removeClass("active");
            $(this).addClass("active");
            $('.content-in').slideUp(200);
            $(this).children('.content-in').slideDown(200);
        }
    });
    if ($(window).width() < 1100) {
        var swiper = new Swiper('.second-section .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: false,
            pagination: {
                clickable: true,
                el: '.second-section .swiper-pagination',
            },
        });
    }
    if ($(window).width() < 410) {
        $('.cta-section option').each(function () {
            var text = $(this).text();
            if (text.length > 20) {
                text = text.substring(0, 19) + '...';
                $(this).text(text);
            }
        });
    }
    if ($(window).width() < 767) {
        var swiper = new Swiper('.three-section .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: false,
            pagination: {
                clickable: true,
                el: '.three-section .swiper-pagination',
            },
        });
    }
    var swiper = new Swiper('.five-section .swiper-container', {
        slidesPerView: 2,
        spaceBetween: 50,
        loop: true,
        autoplay: true,
        pagination: {
            clickable: true,
            el: '.five-section .swiper-pagination',
        },
        breakpoints: {
            1023: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1,
                autoplay: false,
            },
        }
    });
    var swiper = new Swiper('.sidebar .swiper-container', {
        slidesPerView: 1,
        spaceBetween: 50,
        loop: true,
        autoplay: true,
        pagination: {
            clickable: true,
            el: '.sidebar .swiper-pagination',
        },
        breakpoints: {
            1023: {
                slidesPerView: 1
            },
        }
    });
    $('.toggle-text').click(function () {
        if ($(this).prev().hasClass('active')) {
            $(this).prev().removeClass("active");
            $(this).removeClass("active");
            $(this).children('.changing-text').text('Read more');
            var destination = $('.six-section').offset().top;
            $('html,body').animate({
                scrollTop: destination - 156
            }, 300);
        } else {
            $(this).prev().addClass('active');
            $(this).addClass('active');
            $(this).children('.changing-text').text('Hide');
        }
    });
    $('.close-coupon').click(function () {
        $(".coupon-line").addClass('hide');
        $("footer").addClass('without-coupon');
        document.cookie = 'cta' + "=1; path=/; expires=" + 1509609319;
    });
    $(".footer-select").click(function () {
        $(".links-list-one, .links-list-two").slideToggle();
    });
    $('[class|="menu-button"], .overlay').click(function () {
        if ($('.right-header').hasClass('active')) {
            $('.right-header, header').removeClass("active");
            $('.overlay').css({
                'opacity': '0',
                'visibility': 'hidden'
            });
            $('html, body').attr('style', '');
        } else {
            $('.right-header, header').addClass('active');
            $('.overlay').css({
                'opacity': '1',
                'visibility': 'visible'
            });
            $('html, body').attr('style', 'height: 100%;overflow: hidden;width: 100%;position: fixed;');
        }
    });
    if ($(window).width() > 767 && $(window).width() < 1100) {
        $(".menu-point:last-child .point-links").clone().addClass('clone-sign').appendTo(".short-line");
    }
});
$(document).ready(function () {
    if ($('*').is('.field-error')) {
        $(this).style('box-shadow: 0px 0px 0px 3px rgba(224, 49, 0, 1);');
    }
});

function getCookie(a) {
    var b = document.cookie.match(new RegExp("(?:^|; )" + a.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"));
    return b ? decodeURIComponent(b[1]) : undefined
};

function writeCookie(name, value, days) {
    var date, expires;
    if (days) {
        date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}
$(".coupon-href").click(function () {
    writeCookie("writemyessay_dis_hide", true, 360);
    $(".coupon").fadeOut(300);
});
$('#live-chat').click(function () {
    $zopim(function () {
        $zopim.livechat.window.show();
    });
})
$(function () {
    if ($('*').is('.cp-banner-new')) {
        if ($(window).width() < '768') {
            $('.callback-icon').css('bottom', '30px');
        }
    } else {
        $('.callback-icon').css('bottom', '30px');
    }
    $(window).resize(function () {
        if ($('*').is('.cp-banner-new')) {
            if ($(window).width() < '768') {
                $('.callback-icon').css('bottom', '30px');
            }
        } else {
            $('.callback-icon').css('bottom', '30px');
        }
    });
});
$('.button-custom').click(function () {
    var one = $('.first input').val();
    var two = $('.two input').val();
    if (one == '') {
        if (two == '') {
            $('.two .error-text').css('display', 'block');
            $('.first .error-text').css('display', 'block');
            $('.first .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(232,95,118, .4);');
            $('.two .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(232,95,118, .4);');
        } else {
            $('.two .error-text').css('display', 'none');
            $('.first .error-text').css('display', 'block');
            $('.first .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(232,95,118, .4);');
            $('.two .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(0,0,0, .4);');
        }
    } else {
        if (two == '') {
            $('.two .error-text').css('display', 'block');
            $('.first .error-text').css('display', 'none');
            $('.two .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(232,95,118, .4);');
            $('.first .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(0,0,0, .4);');
        } else {
            $('.two .error-text').css('display', 'none');
            $('.first .error-text').css('display', 'none');
            $('.first .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(0,0,0, .4);');
            $('.two .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(0,0,0, .4);');
        }
    }
});
$('.first input').on('keyup', function () {
    $('.js-phone-name').removeClass('field-error');
    $('.first .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(0,0,0, .4);');
    $('.first .error-text').css('display', 'none');
});
$('.two input').on('keyup', function () {
    $('.js-phone-name').removeClass('field-error');
    $('.two .popup__discount__form-row-group').attr('style', 'box-shadow: 0px 2px 6px 0px rgba(0,0,0, .4);');
    $('.two .error-text').css('display', 'none');
});
