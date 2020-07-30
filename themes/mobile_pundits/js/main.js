$ = jQuery.noConflict();
var fullpage_running = false;
function isTouchDevice() {
    return typeof window.ontouchstart !== 'undefined';
}
function initFullPageJs() {
    fullpage_running = true;
    $('#fullpage').fullpage({
        sectionsColor: [],
        navigation: true,
        navigationPosition: 'right',
        responsive: 900,
        slideSelector: '.insta-con-touch',
        //paddingTop: $("#fullpage").hasClass("inner-page-class") ? '148px ' : '110px',
        paddingTop: $("#fullpage").hasClass("inner-page-class") ? '100px ' : '80px',
        normalScrollElements: '.modal ,dropdown-menu open',
        setKeyboardScrolling: false
    });
}

$(document).ready(function () {
    $(".inner-page-carousel .slider-content p").hide();//remove subcontent on inner page head carousel
    if (isTouchDevice()) {
        if (($(window).height()) > 500) {
            $("body").on("scroll", function () {
            });
        }
        fullpage_running = false;
    }
    /*****************************On window resize START  *************************/
    $(window).resize(function () {
        $(window).trigger('scroll');
        if (($(window).width() < 991 || $('div').hasClass('simple_scroller'))) {// ||  (isTouchDevice())
            if ($.fn.fullpage.length) {
                fullpage_running = false;
            }
        }
        if (($(window).width() < 767)) { //Checklist page form stick code//768
            $(".change").removeAttr("id");
        }
    });
    /*****************************On window resize END  *************************/
    /***********************Code for touch and desktop  START**********************/
    if (($(window).width() > 991) || isTouchDevice()) {
        $("#lot0 ,.first_tab,#tab0").addClass("active");
        if (isTouchDevice()) {
            fullpage_running = false;
            $("#section0").addClass("innerpage-slide2");
            $(".innerpage-slide2").css("padding-top", "118px");
            $(".innerpage-slide2").css("height", "70%");
            $(".award-sec-main").css("min-height", "550px");
            $(".pad-top0").css("padding-top", "20px");
            $("#footer").removeClass("footer").addClass('footer-inner clearfix');//removing footer class when slimscroll is active
            $("#footer > div").addClass("foot-non-scro");
            if (($('div').hasClass('slim_scroller'))) {
                $(".inner-page-class .innerpage-slide2").css("padding-top", "145px");
                $(".no_head").css("padding-top", "72px");
            }
            if (($("div").hasClass("simple_scroller"))) {
                $(".inner-page-carousel").css("padding-top", "142px");
            }
            $(".partner-main").css("min-height", "350px").css("margin-top", "20px");
            $("#block-content-custom-modules-front-page-award-block .getfree-form").css("margin-top", "25px");
            $("#PostList").css({"overflow-y": "auto", "-webkit-overflow-scrolling": "touch"});
            $(".carousel-control").removeAttr("href");//15-4-16
            if (($('div').hasClass('simple_scroller'))) {
                if (!$("div").hasClass("top-sub-menu")) {
            $("#myCarousel-inner").addClass("without-sub-bar");
                }
            }
        }
        else {
            if (($('div').hasClass('simple_scroller'))) {//If body Contain more than 3 section than slim scroller will be active  
                $("#footer").removeClass("footer").addClass('footer-inner clearfix');//removing footer class when slimscroll is active
                $("#footer > div").addClass("foot-non-scro");//add class for a footer
                $('html,body').css('overflow', '');
                $("#myCarousel-inner").addClass("innerpage-slide2");
                if (!$("div").hasClass("top-sub-menu")) {
                    $(".innerpage-slide2").css("padding-top", "100px"); //add padding margin //14-4-16
                }
            }
            if (($('div').hasClass('slim_scroller'))) {
                $("#footer").addClass("footer");
                //slim_scroller_footer
                fullpage_running = true;
                initFullPageJs();
            }
        }
    }
     if (($(window).width() < 1024)){
           $(".dropdown_main_menu").removeClass('active');
     }
    /***********************Code for touch and desktop  END************************/
    /****************************Remove top-barmain Start**************************/
    $(window).scroll(function () {
        if ($(window).width() < 500) {
            if ($(document).scrollTop() > 150) {
                $(".top-barmain").slideUp();
                if ($(document).scrollTop() + ($(window).height()) > (($(document).height()) / 1.2)) {
                    $(".scrore-main").css({position: 'relative', top: "5px"});
                }
                else {
                    $(".scrore-main").css({position: 'fixed', top: "45px"});
                }
            }
            else if ($(document).scrollTop() < 150) {
                $(".top-barmain").slideDown();
            }
        }
        if ($(window).width() > 500 && $(window).width() < 767) {
            if ($(document).scrollTop() > 150) {
                $(".top-barmain").slideUp();
                $(".scrore-main").css('position', 'fixed').css("top", "50px");
                if ($(document).scrollTop() + ($(window).height()) > (($(document).height()) / 1.1)) {
                    $(".scrore-main").css('position', 'relative').css("top", "0px");
                }
                else {
                    $(".scrore-main").css('position', 'fixed').css("top", "45px");
                }
            }
            else if ($(document).scrollTop() < 150) {
                $(".top-barmain").slideDown();
            }
        }
    });
    /*****************************Remove top-barmain END***************************/
    
     if (($(window).width() < 768)) {//Checklist page form stick code
        $(".change").removeAttr("id");
    }
    if (($(window).width() > 1024) || isTouchDevice()) {
        if (($(window).width() > 768)) {
            $(".main-nav > li").click(function () {//
                $(".main-nav.navbar-nav > li:hover  ").mousemove(function () {
                    $(".dropdown_main_menu").removeClass("open");
                });
            }).on("touchstart", function () {
                $(".main-nav.navbar-nav > li:hover ,.main-nav.navbar-nav > li:tap ").mousemove(function () {
                    $(".dropdown_main_menu").removeClass("open");
                });
            });
        }
    }
    /****************************Swipe on touch START*******************************/
    var screen_width = $(window).width();
    $(".fp-tableCell").css("max-width", screen_width);//SET max width according to screen size
    /*Header carousel swipe code Start*/
    var head_bullets = $('.head-car .carousel-indicators li');
    window.mySwipe = new Swipe(document.getElementById('slider'), {
        startSlide: 0,
        speed: 1000,
        auto: 4000,
        continuous: true,
        disableScroll: false,
        stopPropagation: false,
        callback: function (pos) {
            var i = head_bullets.length;
            while (i--) {
                head_bullets[i].className = ' ';
            }
            head_bullets[pos].className = 'active';
        },
    });
    $(".head-car .carousel-indicators  li ").click(function () {
        window.mySwipe.slide($(this).index());
    });
    $('#slider').hover(function () {
        window.mySwipe.stop();
    }, function () {
        window.mySwipe.start();
    });
    /*Header carousel swipe code END*/
    /*Partner carousel swipe code Start*/
    var partner_bullets = $('#quote-carousel .carousel-indicators li');
    window.partner_Swipe = new Swipe(document.getElementById('partner_slider'), {
        startSlide: 0,
        speed: 1000,
        auto: 6000,
        continuous: true,
        disableScroll: false,
        stopPropagation: false,
        callback: function (pos) {
            var i = partner_bullets.length;
            while (i--) {
                partner_bullets[i].className = '';
            }
            partner_bullets[pos].className = 'active';
        },
    });
    $("#quote-carousel .carousel-indicators  li ").click(function () {
        window.partner_Swipe.slide($(this).index());
    });
    $("#quote-carousel .left").click(function () {
        partner_Swipe.prev();
    });
    $("#quote-carousel .right").click(function () {
        partner_Swipe.next();
    });
    /*Partner carousel swipe code END*/
    /**********************Swipe on touch END**************************************/
    /*******************side popup Crossbox js START*******************************/
    var height;
//    var available; var percentage_of_page;//    var half_screen;
    $('.bannerbutton').click(function () {
        jQuery('.slide-popup').removeClass('display-block');
        jQuery('.slide-popup').css("display", "none");
    });
    jQuery(window).scroll(function (e) {
        height = $(document).scrollTop();
        if ($(document).scrollTop() > 200) {
            jQuery('.slide-popup').addClass('display-block');
        } else {
            jQuery('.slide-popup').removeClass('display-block');
        }
    });
    /*********************side popup Crossbox js END*******************************/
    /*Browser issue js CODE*/
    var matched, browser;
    jQuery.uaMatch = function (ua) {
        ua = ua.toLowerCase();
        var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
                /(webkit)[ \/]([\w.]+)/.exec(ua) ||
                /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
                /(msie)[\s?]([\w.]+)/.exec(ua) ||
                /(trident)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
                ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
                [];
        return {
            browser: match[ 1 ] || "",
            version: match[ 2 ] || "0"
        };
    };
    matched = jQuery.uaMatch(navigator.userAgent);//IE 11+ fix (Trident) 
    matched.browser = matched.browser == 'trident' ? 'msie' : matched.browser;
    browser = {};
    if (matched.browser) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
    }
// Chrome is Webkit, but Webkit is also Safari.
    if (browser.chrome) {
        browser.webkit = true;
    } else if (browser.webkit) {
        browser.safari = true;
    }
    jQuery.browser = browser;
// log removed - adds an extra dependency //log(jQuery.browser)
});
$(function () {
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }
           $svg = $svg.removeAttr('xmlns:a'); // Remove any invalid XML tags as per http://validator.w3.org
            // Check if the viewport is set, else we gonna set it if we can.
            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
            $img.replaceWith($svg);// Replace image with new SVG
        }, 'xml');
    });
});
