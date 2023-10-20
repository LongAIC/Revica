(function ($) {

    $("input[name='dateOfBirth']").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:2099'
    });
    // Menu-mobile
    $('.zek_touch_menu').click(function () {
        $('body').addClass('zek_active');
    });
    $('.zek_line_dark').click(function () {
        $('body').removeClass('zek_active');
    });
    $("#zek_menu_mobile .mega-menu li.mega-menu-item-has-children> a").after('<i class="fa-regular fa-plus"></i>');
    $('#zek_menu_mobile .mega-menu li.mega-menu-item-has-children i').click(function () {
        $(this).parent('li').children('ul').stop(0).slideToggle(300);
        $(this).stop(0).toggleClass('fa-minus').toggleClass('fa-plus');
    });
    // Menu-sidebar
    $(".zek_sidebar .menu li.menu-item-has-children> a").after('<i class="fa-solid fa-caret-down"></i>');
    $('.zek_sidebar .menu li.menu-item-has-children i').click(function () {
        $(this).parent('li').children('ul').stop(0).slideToggle(300);
    });
    $('.zek_sidebar .widget_categories >ul ul.children').parent('li').addClass('cat-parrent');
    $(".zek_sidebar .widget_categories >ul li.cat-parrent> a").after('<i class="fa-solid fa-caret-down"></i>');
    $('.zek_sidebar .widget_categories >ul li.cat-parrent i').click(function () {
        $(this).parent('li').children('ul').stop(0).slideToggle(300);
    });

    // Back-top
    $("#back-top").hide();
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 500) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
        $('#back-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
    // Fixed-top
    $(window).load(function () {
        $('.head').after('<div class="zek_fake_head"></div>');
        var nav = $('.head');
        var navheight = nav.outerHeight(true);
        $('.zek_fake_head').height(navheight).hide();
        navs = nav.position().top;
        console.log(navs)
        $(window).scroll(function () {
            var that = $(this);
            if (that.scrollTop() > navs) {
                nav.addClass("navbar-fixed-top");
                $('.zek_fake_head').show();
            } else {
                nav.removeClass("navbar-fixed-top");
                $('.zek_fake_head').hide();
            }
        });
    });
    // Ajax Contact-form7
    $('.wpcf7-submit').click(function () {
        var thisElement = $(this);
        var oldVal = thisElement.val();
        var textLoading = 'Đang xử lý ...';
        $('.cf7_submit .ajax-loader').remove();
        thisElement.val(textLoading);
        document.addEventListener('wpcf7submit', function (event) {
            thisElement.val(oldVal);
        }, false);
    });
    // Add-class
    $('table').addClass('table table-bordered');
    $(".phone-container input").attr("placeholder", "0912345678");
    // Click-run
    $(".zek_link_move").click(function (a) {
        var i = this.getAttribute("href");
        if ("" != i) {
            var t = $(i).offset().top - 67;
            $(window).width() <= 1190 && (t += 7), $("html, body").animate({
                scrollTop: t
            }, 500)
        }
    });
    // Click-block
    $('.button_click').click(function () {
        $(this).stop(0).toggleClass('button_click').toggleClass('button_click off');
        $('.hidden_gr').slideToggle(300);
        return false;
    });
    $('.zek_library_sec1 .button_showmore button').click(function () {
        if ($('.zek_library_sec1 .col-item.hidden_item').hasClass('active')) {
            $('.zek_library_sec1 .col-item.hidden_item').removeClass('active').addClass('');
        } else {
            $('.zek_library_sec1 .col-item.hidden_item').removeClass('').addClass('active');
        }
    });
    $('.zek_library_sec1 .button_showmore button').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active').addClass('');
        } else {
            $(this).removeClass('').addClass('active');
        }
    });
    // Js-tab
    $('.zek_dictionary_sec2 .nav-link').click(function () {
        $('.zek_dictionary_sec2 .nav-link').removeClass('active');
        $(this).addClass('active');
        $('.zek_dictionary_sec2 .tab-pane').removeClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab11').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic11').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab12').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic12').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab13').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic13').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab14').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic14').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab15').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic15').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab16').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic16').addClass('active show');
    });

    $('.zek_dictionary_sec2 .nav-link#dic-tab21').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic21').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab22').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic22').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab23').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic23').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab24').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic24').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab25').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic25').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab26').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic26').addClass('active show');
    });

    $('.zek_dictionary_sec2 .nav-link#dic-tab31').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic31').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab32').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic32').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab33').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic33').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab34').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic34').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab35').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic35').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab36').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic36').addClass('active show');
    });

    $('.zek_dictionary_sec2 .nav-link#dic-tab41').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic41').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab42').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic42').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab43').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic43').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab44').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic44').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab45').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic45').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab46').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic446').addClass('active show');
    });

    $('.zek_dictionary_sec2 .nav-link#dic-tab51').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic51').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab52').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic52').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab53').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic53').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab54').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic54').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab55').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic55').addClass('active show');
    });
    $('.zek_dictionary_sec2 .nav-link#dic-tab56').click(function () {
        $('.zek_dictionary_sec2 .tab-pane#dic56').addClass('active show');
    });


    // Swiper
    var swiper = new Swiper(".mySwiper_home_banner", {
        loop: true,
        slidesPerView: "1",
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiper = new Swiper(".mySwiper_scroll1", {
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        scrollbar: {
            el: ".swiper-scrollbar",
            hide: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 16,
            },
            432: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
    });

    var swiper = new Swiper(".mySwiper_scroll2", {
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        scrollbar: {
            el: ".swiper-scrollbar",
            hide: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            432: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 22,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 56,
            },
        },
    });
    var swiper = new Swiper(".mySwiper_scroll3", {
        scrollbar: {
            el: ".swiper-scrollbar",
            hide: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            432: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 42,
            },
        },
    });
    var swiper = new Swiper(".mySwiper_service", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next-rl",
            prevEl: ".swiper-button-prev-rl",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            432: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 90,
            },
        },
    });
    //
})(jQuery);

$(document).ready(function () {
    var dataSrc = $('#vid1').data('src');
    var divStyle = $('#vid1').attr('style');
    if ($('#vid1').length > 0) {
        var matchHeight = divStyle.match(/height:([^;]+)/);
        var divHeight = matchHeight ? matchHeight[1] : '230px';
        var videoId = dataSrc.replace("https://www.youtube.com/embed/", "");
        var embedUrl = 'https://www.youtube.com/embed/' + videoId;
        var iframe = $('<iframe>').attr({
            'width': '100%',
            'height': divHeight,
            'src': embedUrl,
            'frameborder': '0',
            'allowfullscreen': ''
        });
        $('#vid1').replaceWith(iframe);
    }

    $("#thong_tin_tai_khoan").click(function (e) {
        e.preventDefault();
        $("#tab-taikhoan").click();
    });
    // $('.input-append.date').datetimepicker({
    //     language: 'pt-BR'
    // });

$(".add-on").click(function(){
    $("input[name='choose_date']::-webkit-calendar-picker-indicator").trigger("click");
})
});