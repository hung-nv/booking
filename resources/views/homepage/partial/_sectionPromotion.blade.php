<section class="parallax-section" data-scrollax-parent="true">
    @if(!empty($option['promotion_background']))
        <div class="bg 0" style="background-image: url({{ $option['promotion_background'] }})"></div>
    @else
        <div class="bg 0" style="background-image: url({{ asset('images/bg/14.jpg') }})"></div>
    @endif
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="colomn-text fl-wrap">
                    <div class="colomn-text-title">
                        <h3>
                            @if(!empty($option['promotion_heading']))
                                {{ $option['promotion_heading'] }}
                            @endif
                        </h3>
                        <p>
                            @if(!empty($option['promotion_description']))
                                {{ $option['promotion_description'] }}
                            @endif
                        </p>
                        @if(!empty($option['promotion_booking_label']))
                            <a href="{{ $option['promotion_booking_url'] or '/search?lang='.$lang }}"
                               class="btn  color-bg float-btn">
                                {{ $option['promotion_booking_label'] }}<i class="fal fa-plus"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
