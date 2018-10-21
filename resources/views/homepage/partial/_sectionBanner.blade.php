<section class="hero-section" data-scrollax-parent="true" id="sec1" style="padding: 115px 0 70px;">
    <div class="hero-parallax">
        <div class="bg banner-parallax" style="background-image: url({{ asset('images/bg/22.jpg') }})"></div>
        <div class="overlay op7"></div>
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
                <h2 style="font-size: 33px">EasyBook Hotel Booking System</h2>
                <span class="section-separator"></span>
                <h3>Let's start exploring the world together with EasyBook</h3>
            </div>
            @if(Request::is('/'))
                <div class="main-search-input-wrap" style="margin: 0 auto;">
                    <div class="main-search-input fl-wrap">
                        <div class="main-search-input-item location" id="autocomplete-container">
                            <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
                            <input type="text" placeholder="Hotel , City..." class="autocomplete-input"
                                   id="autocompleteid2" value="">
                            <a href="#"><i class="fal fa-dot-circle"></i></a>
                        </div>
                        <div class="main-search-input-item main-date-parent main-search-input-item_small">
                            <span class="inpt_dec"><i class="fal fa-calendar-check"></i></span>
                            <input type="text" placeholder="When" name="main-input-search" value="">
                        </div>

                        <button class="main-search-button color2-bg">Search <i class="fal fa-search"></i></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="header-sec-link hidden">
        <div class="container"><a href="#sec2" class="custom-scroll-link color-bg"><i
                        class="fal fa-angle-double-down"></i></a></div>
    </div>
</section>