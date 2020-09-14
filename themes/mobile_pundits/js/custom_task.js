$(document).ready(function () {
//  $('<div class="g-recaptcha" data-sitekey="6LeDPlUUAAAAAC14BexZMoP1gqvSbLZSfYigjUvfcXkroScK"></div>').insertBefore("#webform-client-form-292 .url-textfield");
    //$().append('');
    /*Extra*/
//    $.ajax({type: "POST",
//            url: Drupal.settings.basePath + 'blog',
//            success: function (result) {
//                alert(result);
//            }
//        });
//  
$('#contact_list').selectpicker();    
    /******************************--owl_carousel random function---***************/
    function random(owlSelector) {
        owlSelector.children().sort(function () {
            return Math.round(Math.random()) - 0.5;
        }).each(function () {
            $(this).appendTo(owlSelector);
        });
    }
    /********************Carousel on success stories page code START ***************/
    function success_story_tab_hor_ver(tab_id) {
        var count = 0;
        while (($(tab_id + count).has(tab_id + count)).length > 0) {//Verticle
            $(tab_id + count).owlCarousel({
                navigation: true,
                beforeInit: function (elem) {//Call beforeInit callback, elem parameter point to $("#suc_v_")
                    random(elem);
                }
            });
            count++;
        }
    }
    /*Horizontal and verticle carousel on success stories page START*/
    success_story_tab_hor_ver('#suc_v_');
    success_story_tab_hor_ver('#suc_h_');
    /*Horizontal and verticle carousel on success stories page END*/
    /********************Carousel on success stories page code END ****************/
    /******************************Creating tabs condition start*******************/
    var count = 0;
    while (($('ul').has('#myTabs' + count)).length > 0) {
        $('#myTabs' + count + 'a').click(function (e) {//e.preventDefault();
            $(this).tab('show');
        });
        count++;
    }
    /***********************Creating tabs  condition end***************************/
    /****************Carousel on FRONT page resource section START*****************/
    count = 0;
    while (($('div').has('#owl-demo' + count)).length > 0) {
        $("#owl-demo" + count).owlCarousel({
            navigation: true,
            pagination: false,
            items: 5,
            dotsContainer: false,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 3],
            itemsTablet: [768, 3],
            itemsTabletSmall: [700, 2],
            itemsMobile: [479, 1],
            beforeInit: function (elem) {//Call beforeInit callback, elem parameter point to $("#owl-demo")
                random(elem);
            }
        });
        count++;
    }
    /**********************Carousel on FRONT page resource section END*************/
    /***********************Adding carousel Inside RESOUCES page*******************/
    count = 0;
    while (($('div').has('#carousel' + count)).length > 0) {
        console.log(($('div').has('#carousel' + count)).length);
        $("#carousel" + count).owlCarousel({
            navigation: true,
            items: 4,
            dotsContainer: false,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: false,
            itemsMobile: [479, 1],
            beforeInit: function (elem) {//Call beforeInit callback, elem parameter point to $("#owl-demo")
                random(elem);
            }
        });
        count++;
    }
        $("#related-succ-stories").owlCarousel({//related_carousel0
            navigation: true,
            navClass:['',''],
            items: 3,
            dotsContainer: false,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: [540, 1],
            itemsMobile: [479, 1],
            beforeInit: function (elem) {//Call beforeInit callback, elem parameter point to $("#owl-demo")
                random(elem);
            }
        });
    
    /************************Carousel Inside RESOUCES page End*********************/
    /********************Popup code start******************************************/
    //Open or close popup on lets button click and reset a form
    $(".talk-btn a").on("click", function (e) {
        e.preventDefault();
          window.open($(this).attr("href"), '_blank');
    });
    //**********Open or close popup on lets button click and reset a form END***
    //****Close model and  reset a form on button click  and ESC key press STSRT
    $(".close-btn ,.close").on("click", function () {
        $('.modal-content form').trigger("reset");
        $('.modal-content .error').remove('label');
        $('.modal-content input').removeClass('error');
        if (($("div").hasClass("simple_scroller")) || $(window).width() < 991) {
            $("body").css("overflow-y", "auto");
        }
    });
    $('body').keypress(function (e) {
        if (e.keyCode == 27) {
            $('.modal-content form').trigger("reset");
            $('.modal-content .error').remove('label');
            $('.modal-content input').removeClass('error');
            $.fn.fullpage.setAllowScrolling(true);//$.fn.fullpage.sectionSelector('');
        }
    });
    $(".cont-page").on("click", function () {
        $('.body-space').css("overflow-y", "hidden");
        $("#contact_page_form #webform-client-form-292 .checklist_form_btn").val("Submit");
        $("#contact_page_form ").find(".success_msg_class").hide();
        $("#contact_page_form  #webform-client-form-292").show().trigger("reset");//reset this form on reload a page
    });
    $("#contact_page_form").on("click", function () {//Set default value inside a dropdown when contact us popup is toggle
        $('#webform-client-form-269 .selectpicker').selectpicker('refresh');
    });
    $(".tabs-hori-succ li").on("click", function () {
        $(".tab-suces-ver li").removeClass("active");
    });
    $(".tab-suces-ver li").on("click", function () {
        $(".tabs-hori-succ li").removeClass("active");
    });
    //Close model and  reset a form on button click  and ESC key press END 
    //Open a header carousel popup START
    $(".carousel_link").on('click',function(){ 
        var id = $(this).attr("value"); 
        $("#back_bg_popup").show();
        $("#back_bg_car").show();
        $.ajax({type: "POST",
            url: base_path + 'popup_model',
            data: {id: id},
            success: function (result) {
                if (result.html !== "") {
                    $(".popup").html(result.html).find(".selectpicker").selectpicker({
                        liveSearch: true
                    });
                    $('#pop_talkmsg').hide();
                    $("#webform-client-form-99 ").show();
                    $(".pdf_dwn").on('click',function(event){ 
                        event.preventDefault();//PDF DOWNLOAD 
                        var pdf_id = ($(this).attr("href")).split("/").pop();
                        window.location.assign("download/pdf/" + pdf_id);
                    });
                    $("#back_bg_popup").hide();
                    $("#" + id).modal('toggle');
                    var no_imgs = $(".screen-img").length;
                    var test_width = 12 / no_imgs;
                    if (no_imgs == 3) {
                        $(".screen-img").addClass("col-md-" + test_width + " col-sm-4");
                    } else {
                        $(".screen-img").addClass("col-md-" + test_width + " col-sm-6");
                    }
                    $(".get-form input ").on("focus", function () {
                        $.fn.fullpage.setKeyboardScrolling(false);
                    }).on("blur", function () {
                        $.fn.fullpage.setKeyboardScrolling(true);
                    });
                }
            }
        });
    });
    $(".success-story").click(function (e) { 
        $("#back_bg_popup").show();
        var id = $(this).attr("value");
        e.preventDefault();
        $.ajax({type: "POST",
            url: base_path + 'popup_model',
            data: {id: id},
            success: function (result) { 
                if (result.html !== "") {
                    $(".popup").html(result.html).find(".selectpicker").selectpicker({liveSearch: true});
                    $('#pop_talkmsg').hide();
                    $("#webform-client-form-99 ").show();
                    $(".pdf_dwn").on('click',function(event){ 
                        event.preventDefault();//PDF DOWNLOAD 
                        var pdf_id = ($(this).attr("href")).split("/").pop();
                        window.location.assign("download/pdf/" + pdf_id);
                    });
                    $("#back_bg_popup").hide();
                    $("#" + id).modal('toggle');
                    var no_imgs = $(".screen-img").length;
                    var test_width = 12 / no_imgs;
                    if (no_imgs == 3) {
                        $(".screen-img").addClass("col-md-" + test_width + " col-sm-4");
                    } else {
                        $(".screen-img").addClass("col-md-" + test_width + " col-sm-6");
                    }
                }
            }
        });
    });
    //Open a header carousel popup END
    /********************Popup code END *******************************************/
    //Remove class "top-nav-inner" when submenu div bar is not exist on page
    if (!($("div").hasClass("top-sub-menu"))) {
        $("div").removeClass("top-nav-inner");
    }
    /**********ADD and remove scrolling of  slim scroller in fullpage js***********/
    /*.slim_scroller input ,#free_consultation_form_popup input ,#contact_page_form input,*/
    $('.content-tab').on('show.bs.collapse', '#collapse-tabs-0', function () {
        $('#collapse-tabs-0 .in').collapse('hide');
    });
    
    $('.horizontal_content').on('show.bs.collapse', '#collapse-myTab', function () {
        $('#collapse-myTab .in').collapse('hide');
    });
    
    $('.webform-component-select').on('focus', '.input-block-level', function () {
        $.fn.fullpage.setKeyboardScrolling(false);
        $.fn.fullpage.setMouseWheelScrolling(false);
    }).on('blur', '.input-block-level', function () {
        if (fullpage_running == true) {
            $.fn.fullpage.setKeyboardScrolling(true);
            $.fn.fullpage.setMouseWheelScrolling(true);
        }
    });
    $("form input ").on("focus", function () {
        if (fullpage_running == true) {
            console.log("inside");
            $.fn.fullpage.setKeyboardScrolling(false);
        }
    }).on("blur", function () {
        if (fullpage_running == true) {
            $.fn.fullpage.setKeyboardScrolling(true);
        }
    });
    /************ADD and remove scrolling of  slim scroller in fullpage js END*****/
    /*************************Code for Light box START*************************/
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
    $(".ekko-lightbox .modal-dialog").attr("id", "ekko_dialog");
    $(".ekko-lightbox").attr("id", "ekko_main");
    $.fn.ekkoLightbox.defaults = {
        always_show_close: true,
        no_related: true,
        scale_height: true,
        footer: " ",
        loadingMessage: 'Loading...',
        onShow: function () {
            var $e = $(".ekko-lightbox");
            $e.find(".modal-dialog").css("min-width", "55%").css("max-height", "0px");
            /*Insight popup radd close using js*/
            $e.find('.modal-header .close').text("");
            var close_span = $('<span></span>').text("X");
            $('.ekko-lightbox .modal-header .close').append(close_span);
        },
        onShown: function () {
        },
        onHide: function () {
            $('#light_pop_form').hide();
        },
        onHidden: function () {
        }, onNavigate: function () {
        },
        onContentLoaded: function () {
            var $e = $(".ekko-lightbox").removeAttr("tabindex");
            $e.find(".modal-footer").addClass("light_footer").show();
            //Add download link on footer
            var e = $('<div></div>');
            $('.light_footer').append(e);
            e.attr("id", "light_dwn_link");
            $("#light_dwn_link").show().click(function () {//light download img click 
                $(".light-info").show();
                $("#webform-client-form-55").show().trigger('reset');
                $("#insight-talkmsg").hide();
                $('#light_pop_form').css("position", "fixed").show(); //$("#webform-client-form-55")
                $('#webform-client-form-55 .error').remove('label');
                $('#webform-client-form-55 input').removeClass('error');
            });
        }
    };
    /*************************Code for Light box END*************************/
    $('form .selectpicker').selectpicker({//Live search enable on each form dropdown
        liveSearch: true
    });
    //Scroll page when user click on instamobile contact us button
    $('.cont-btn a').on("click", function (e) {
        $(this).attr("href", "#contact-form");
        if (fullpage_running) {
            e.preventDefault();
            $.fn.fullpage.moveTo($('.fp-section').length);
        }
    });
    
    //Showing a View more button on succes-story click tab
    $('.resource-tabs li ').click(function () {
        if ($(this).hasClass("succ-tab")) {
            $("#succ_view_btn").show();
        }
        else {
            $("#succ_view_btn").hide();
        }
    });
    /*Open pdf and new page on resources template and checklist click*/
    $(".templates").on("click", function (e) {
        e.preventDefault();
        window.open($(this).attr("href"), '_blank');
    });
    $(".checklist_img").on("click", function (e) {
        e.preventDefault();
        window.open($(this).attr("href"));
    });
    /*Open pdf and new page on resources template and checklist click END*/
    /*Adding link on service block images*/
    $(".services-main .mobility a").attr("href", "Enterprise_Mobile_Development.html");
    $(".services-main .wearable a").attr("href", "internetofthings.html");
    $(".services-main .testing a").attr("href", "Outsource_Mobile_Testing.html");
    $(".services-main .cloud a").attr("href", "iot-cloud");
    //close tab when new tab is open
    $('.content-tab').on('show.bs.collapse', '#collapse-tabs-0', function () {
        $('#collapse-tabs-0 .in').collapse('hide');
    });
    /*Prevent to scroll background when nav-toggle is open*/
    $(".navbar-collapse").on("shown.bs.collapse", function () {
        $("body").attr("style", "height: 100%;overflow: hidden;");
    }).on("hidden.bs.collapse", function () {
        $("body").attr("style", "");
    });
    /*Prevent to scroll background when nav-toggle is open*/
$('.modal').on('hide.bs.modal', function (e) {
    $("element.style").css("padding-right","0");
});
});

jQuery(function () {
    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }
    var shrinkHeader = 300;
    jQuery(window).scroll(function () {
        var scroll = getCurrentScroll();
        if (scroll >= shrinkHeader) {// Refer http://jsfiddle.net/rohankumar1524/9jws0L8L/ for example
            var fixedOffset = 120;
            if (scroll > shrinkHeader + fixedOffset && $('#theFixed').length) {
                var height_element_parent = $('#theFixed').closest('.checklist-main').outerHeight(), //get high parent element
                        height_element = $('#theFixed').height(), //get high of elemenet
                        position_fixed_max = height_element_parent; //$('footer').height();//height_element_parent - height_element; // get the maximum position of the elemen
                if (scroll - height_element_parent < height_element + fixedOffset) {
                    position_fixed_max -= fixedOffset;
                }
                var position_fixed = (position_fixed_max > scroll ? 0 : position_fixed_max - scroll) + fixedOffset;
                position_fixed = position_fixed < fixedOffset ? position_fixed - fixedOffset : position_fixed; // prevent overlapping on footer
                $('#theFixed').css({
                    top: position_fixed,
                    position: 'fixed'
                });
                if ($(window).width() == 768) {
                    $('#theFixed').css({
                        width: '28.6%'
                    });
                }
                else {
                    $('#theFixed').css({
                        width: '25.3%'
                    });
                }
            }
        }
        else {
            $('#theFixed').css({position: 'static', width: '100%'});
        }
    });
    // on load forcefully fix the right section 
    $(window).trigger('scroll');
});