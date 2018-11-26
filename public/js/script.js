$(function () {
    var inputDaterange = $('input[name="stay_when"], input[name="bookdates"]');
    var pageHome = $('#homepage');
    var pageSearch = $('#search');
    var btnSearch = $('.main-search-button, .header-search-button');
    var inputRangeSlider = $('.range-slider');
    var btnBookNow = $('#book-room');
    var divFlag = $('.logo-translate');

    $('.close-modal').on('click', function () {
        $('#popupPromotion').modal('hide');
    });

    if (!_cookie('dialog')) {
        _cookie('dialog', 'dialog1', 1);
        setTimeout(function () {
            $('#popupPromotion').modal('show');
        }, 3000); // milliseconds
    }

    if (divFlag.length) {
        divFlag.on('click', '.flag', function () {
            var newLang = $(this).data('lang'),
                currentLang = getParameterByName('lang'),
                url = '';

            if (!currentLang) {
                currentLang = 'en';
            }

            if (newLang !== currentLang) {
                if (_.includes(window.location.href, 'lang=' + currentLang)) {
                    url = window.location.href.replace('lang=' + currentLang, 'lang=' + newLang);
                } else {
                    if (window.location.search) {
                        url = window.location.href + '&lang=' + newLang;
                    } else {
                        url = window.location.href + '?lang=' + newLang;
                    }
                }

                window.location.href = url;
            }
        });
    }

    inputDaterange.daterangepicker({
        autoUpdateInput: false
    });

    inputDaterange.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    if (pageSearch.length || pageHome.length) {
        var viewData = $('#viewData');
        var inputWhere = $('#autocompleteid2');
        var istays = viewData.data('istays');

        // auto complete istay.
        inputWhere.autocomplete({
            source: _.map(istays, 'name'),
            minLength: 0
        }).focus(function () {
            $(this).keydown();
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<div><i class='fal fa-map-marker'></i>" + item.value + "</div>")
                .appendTo(ul);
        };

        // validate input where.
        inputWhere.on('blur', function () {
            if (!_.find(istays, {name: inputWhere.val()})) {
                $(this).val('');
            }
        });

        // validate input date range.
        inputDaterange.on('blur', function () {
            var dateRange = $(this).val(),
                reg = /^\d{1,2}\/\d{1,2}\/\d{4}$/,
                valid = false;

            if (dateRange) {
                dateRange = dateRange.split('-');

                if (dateRange.length > 1 && reg.test(_.trim(dateRange[0])) && reg.test(_.trim(dateRange[1]))) {
                    if (!isNaN(Date.parse(_.trim(dateRange[0]))) && !isNaN(_.trim(Date.parse(dateRange[1])))) {
                        valid = true;
                    }
                }
            }

            if (!valid) {
                $(this).val('');
            }
        });

        // on click button search.
        btnSearch.on('click', function () {
            var dateRange, where, slider, lang, params = {};

            lang = getParameterByName('lang');

            if (!lang) {
                lang = 'en';
            }

            params['lang'] = lang;

            if (inputRangeSlider.length) {
                slider = inputRangeSlider.data("ionRangeSlider");
            }

            dateRange = inputDaterange.val() ? inputDaterange.val() : '';

            if (inputWhere.val() && _.find(istays, {name: inputWhere.val()})) {
                where = _.find(istays, {name: inputWhere.val()}).id;
            }

            if (dateRange) {
                params['dateRange'] = dateRange;
            }

            if (where) {
                params['where'] = where;
            }

            if (slider) {
                params['min'] = slider.result.from;
                params['max'] = slider.result.to;
            }

            window.location.href = '/search?' + $.param(params);
        });
    }

    if (btnBookNow.length) {
        var formBook = $('.book-form'),
            inputDateRange = $('input[name="bookdates"]'),
            inputNumberAdult = $('input[name="qty3"]'),
            inputNumberChild = $('input[name="qty2"]'),
            inputEmail = $('input[name="email"]'),
            inputName = $('input[name="name"]'),
            inputMobile = $('input[name="mobile"]'),
            inputViewData = $('#view_data');

        formBook.validate({
            rules: {
                bookdates: 'required',
                name: "required",
                email: "email",
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 11,
                    digits: true
                }
            }
        });

        btnBookNow.on('click', function (e) {
            e.preventDefault();

            if (formBook.valid()) {
                $('.loading').removeClass('hidden');
                $.ajax({
                    url: '/contact/book',
                    method: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    data: {
                        date: inputDateRange.val(),
                        numberAdult: inputNumberAdult.val(),
                        numberChild: inputNumberChild.val(),
                        email: inputEmail.val(),
                        name: inputName.val(),
                        mobile: inputMobile.val(),
                        room: inputViewData.data('room'),
                        istay: inputViewData.data('istay')
                    }
                }).done(respon => {
                    $('.response-booking').text(respon);

                    $('.loading').addClass('hidden');
                }).fail(xhr => {
                    $('.response-booking').text('Something wrong. Please try again');
                });
            }
        });
    }

    //   scroll to------------------
    $(".custom-scroll-link").on("click", function () {
        var a = 150 + $(".scroll-nav-wrapper").height();
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") || location.hostname === this.hostname) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    $(".to-top").on("click", function (a) {
        a.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    function getParameterByName(name) {
        let match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }

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

    //   lightGallery------------------
    $(".image-popup").lightGallery({
        selector: "this",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        counter: false
    });
    var o = $(".lightgallery"),
        p = o.data("looped");
    o.lightGallery({
        selector: ".lightgallery a.popup-image",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        loop: false,
        counter: false
    });

    function initHiddenGal() {
        $(".dynamic-gal").on('click', function () {
            var dynamicgal = eval($(this).attr("data-dynamicPath"));

            $(this).lightGallery({
                dynamic: true,
                dynamicEl: dynamicgal,
                download: false,
                loop: false,
                counter: false
            });

        });
    }

    initHiddenGal();


    //   Slick------------------
    var sbp = $('.swiper-button-prev'),
        sbn = $('.swiper-button-next');
    $('.fw-carousel').slick({
        dots: true,
        infinite: true,
        speed: 600,
        slidesToShow: 1,
        centerMode: false,
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


    inputRangeSlider.ionRangeSlider({
        type: "double",
        keyboard: true
    });
    $(".rate-range").ionRangeSlider({
        type: "single",
        hide_min_max: true,
    });


    $(".show-hidden-map").on("click", function (e) {
        e.preventDefault();
        $(".show-hidden-map").find("span").text($(".show-hidden-map span").text() === 'Close' ? 'On The Map' : 'Close');
        $(".hidden-map-container").slideToggle(400);
    });

    //   accordion ------------------
    $(".accordion a.toggle").on("click", function (a) {
        a.preventDefault();
        $(".accordion a.toggle").removeClass("act-accordion");
        $(this).addClass("act-accordion");
        if ($(this).next('div.accordion-inner').is(':visible')) {
            $(this).next('div.accordion-inner').slideUp();
        } else {
            $(".accordion a.toggle").next('div.accordion-inner').slideUp();
            $(this).next('div.accordion-inner').slideToggle();
        }
    });

    $('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter(".quantity input"), $(".quantity").each(function () {
        var t = jQuery(this), i = t.find('input[type="number"]'), n = t.find(".quantity-up"),
            a = t.find(".quantity-down"), u = i.attr("min"), r = i.attr("max");
        n.click(function () {
            var n = parseFloat(i.val());
            if (n >= r) var a = n; else a = n + 1;
            t.find("input").val(a), t.find("input").trigger("change")
        }), a.click(function () {
            var n = parseFloat(i.val());
            if (n <= u) var a = n; else a = n - 1;
            t.find("input").val(a), t.find("input").trigger("change")
        })
    });

    function _cookie(_name, _value, _days) {// xx3004 - Extended based on Open Sources
        if (_value != undefined && _name != undefined) {
            if (_days) {
                var date = new Date();
                date.setTime(date.getTime() + (_days * 60 * 60 * 24));
                var _expires = "; expires=" + date.toGMTString();
            }
            else
                var _expires = "";
            document.cookie = _name + "=" + _value + _expires + "; path=/";
        } else if (_name != undefined && !_value) {
            var nameEQ = _name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')
                    c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0)
                    return c.substring(nameEQ.length, c.length);
            }
            return null;
        } else if (_name != undefined && _value === null) {
            _cookie(_name, "", -1);
        }
    }
});