$(function () {
    var inputMainSearch = $('input[name="main-input-search"]');

    inputMainSearch.daterangepicker({
        autoUpdateInput: false
    });

    inputMainSearch.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    var availableTags = [
        "iStay1",
        "iStay2",
        "iStay3",
        "iStay4",
        "iStay5"
    ];

    $("#autocompleteid2").autocomplete({
        source: availableTags,
        minLength: 0
    }).focus(function () {
        // $(this).autocomplete("search");
        $(this).keydown();
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div><i class='fal fa-map-marker'></i>" + item.value + "</div>")
            .appendTo(ul);
    };

    //   Isotope------------------
    function initIsotope() {
        if ($(".gallery-items").length) {
            var a = $(".gallery-items").isotope({
                singleMode: true,
                columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                transformsEnabled: true,
                transitionDuration: "700ms",
                resizable: true
            });
            a.imagesLoaded(function () {
                a.isotope("layout");
            });
        }
    }

    initIsotope();


    //   Slick------------------
    var sbp = $('.swiper-button-prev'),
        sbn = $('.swiper-button-next');
    $('.fw-carousel').slick({
        dots: true,
        infinite: true,
        speed: 600,
        slidesToShow: 1,
        centerMode:false,
        arrows: false,
        variableWidth: true
    });
    sbp.on("click", function () {
        $('.fw-carousel').slick('slickPrev');
    })

    sbn.on("click", function () {
        $('.fw-carousel').slick('slickNext');
    })
    $('.slideshow-container').slick({
        dots: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        fade: true,
        cssEase: 'ease-in',
        infinite: true,
        speed: 1000,
    });
    $('.single-slider').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true
    });
    sbp.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.single-slider').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.single-slider').slick('slickNext');
    });
    $('.slider-container').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
    });
    $('.slider-container').on('init', function (event, slick) {
        initAutocomplete();
    });
    sbp.on("click", function () {
        $(this).closest(".slider-container-wrap").find('.slider-container').slick('slickPrev');

    });
    sbn.on("click", function () {
        $(this).closest(".slider-container-wrap").find('.slider-container').slick('slickNext');
    });
    $('.single-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        dots: true,
        arrows: false,
        centerMode: true,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 2,
                centerMode: false,
            }
        },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    centerPadding: '0',
                }
            }
        ]

    });
    sbp.on("click", function () {
        $(this).closest(".slider-carousel-wrap").find('.single-carousel').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".slider-carousel-wrap").find('.single-carousel').slick('slickNext');
    });
    $('.inline-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        dots: true,
        arrows: false,
        centerMode: false,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 4,
                centerMode: false,
            }
        },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                }
            }
        ]
    });
    $(".fc-cont-prev").on("click", function () {
        $(this).closest(".inline-carousel-wrap").find('.inline-carousel').slick('slickPrev');
    });
    $(".fc-cont-next").on("click", function () {
        $(this).closest(".inline-carousel-wrap").find('.inline-carousel').slick('slickNext');
    });
    $('.footer-carousel').slick({
        infinite: true,
        slidesToShow: 5,
        dots: false,
        arrows: false,
        centerMode: false,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 4,
                centerMode: false,
            }
        },

            {
                breakpoint: 568,
                settings: {
                    slidesToShow: 3,
                    centerMode: false,
                }
            }
        ]

    });
    $(".fc-cont-prev").on("click", function () {
        $(this).closest(".footer-carousel-wrap").find('.footer-carousel').slick('slickPrev');
    });
    $(".fc-cont-next").on("click", function () {
        $(this).closest(".footer-carousel-wrap").find('.footer-carousel').slick('slickNext');
    });
    $('.listing-carousel').slick({
        infinite: true,
        slidesToShow: 4,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: '60px',
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 3,
            }
        },

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,

                }
            },
            {
                breakpoint: 540,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '0',
                }
            }
        ]

    });
    sbp.on("click", function () {
        $(this).closest(".list-carousel").find('.listing-carousel').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".list-carousel").find('.listing-carousel').slick('slickNext');
    });
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        dots: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });
    sbp.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.slider-for').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.slider-for').slick('slickNext');
    });
    $('.light-carousel').slick({
        infinite: true,
        slidesToShow: 2,
        dots: false,
        arrows: false,
        centerMode: false,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 2,
                centerMode: false,
            }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    centerPadding: '0',
                }
            }
        ]
    });
    $(".lc-prev").on("click", function () {
        $(this).closest(".light-carousel-wrap").find('.light-carousel').slick('slickPrev');
    });
    $(".lc-next").on("click", function () {
        $(this).closest(".light-carousel-wrap").find('.light-carousel').slick('slickNext');
    });
    // Styles ------------------
    if ($("footer.main-footer").hasClass("fixed-footer")) {
        $('<div class="height-emulator fl-wrap"></div>').appendTo("#main");
    }
    function csselem() {
        $(".height-emulator").css({
            height: $(".fixed-footer").outerHeight(true)
        });
        $(".slideshow-container .slideshow-item").css({
            height: $(".slideshow-container").outerHeight(true)
        });
        $(".slider-container .slider-item").css({
            height: $(".slider-container").outerHeight(true)
        });
        $(".map-container.column-map").css({
            height: $(window).outerHeight(true) - 110 + "px"
        });
    }
    csselem();


    $(".range-slider").ionRangeSlider({
        type: "double",
        keyboard: true
    });
    $(".rate-range").ionRangeSlider({
        type: "single",
        hide_min_max: true,
    });
});