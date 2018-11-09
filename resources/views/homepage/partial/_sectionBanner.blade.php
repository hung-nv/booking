<section class="hero-section" data-scrollax-parent="true" id="sec1">
    <div class="hero-parallax">
        @if(!empty($option['search_background']))
            @if($agent->isMobile())
                <div class="bg banner-parallax" style="background-image: url({{ $option['search_background_mobile'] }})"></div>
            @else
                <div class="bg banner-parallax" style="background-image: url({{ $option['search_background'] }})"></div>
            @endif
        @else
            <div class="bg banner-parallax" style="background-image: url({{ asset('images/bg/22.jpg') }})"></div>
        @endif
        <div class="overlay op3"></div>
    </div>
    <div class="hero-section-wrap fl-wrap">
        <div class="container">
            <div class="home-intro">
                <div class="section-title-separator">
                    <span>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </div>
                <h2 style="font-size: 33px">{{ $option['search_heading'] or '' }}</h2>
                <span class="section-separator"></span>
                <h3>{{ $option['search_description'] or '' }}</h3>
            </div>
            @if(Request::is('/'))
                <div class="main-search-input-wrap" style="margin: 0 auto;">
                    <div class="main-search-input fl-wrap">
                        <div class="main-search-input-item location" id="autocomplete-container">
                            <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
                            <input type="text" placeholder="{{ $option['search_where_label'] or '' }}..."
                                   class="autocomplete-input"
                                   id="autocompleteid2" value="">
                            <a href="#"><i class="fal fa-dot-circle"></i></a>
                        </div>
                        <div class="main-search-input-item main-date-parent main-search-input-item_small">
                            <span class="inpt_dec"><i class="fal fa-calendar-check"></i></span>
                            <input type="text" placeholder="{{ $option['search_when_label'] or '' }}" name="stay_when" value="">
                        </div>

                        <button class="main-search-button color2-bg">
                            {{ $option['search_label_direct'] or '' }}
                            <i class="fal fa-search"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="header-sec-link">
        <div class="container">
            <a href="#sec2" class="custom-scroll-link color-bg">
                <i class="fal fa-angle-double-down"></i></a>
        </div>
    </div>
</section>