<section class="list-single-hero" data-scrollax-parent="true" id="sec1">
    @if(!empty($istay['image']))
        <div class="bg par-elem" style="background-image: url({{ $istay['image'] }})"></div>
    @else
        <div class="bg par-elem" style="background-image: url({{ asset('images/bg/9.jpg') }})"></div>
    @endif

    <div class="list-single-hero-title fl-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="listing-rating-wrap">
                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                    </div>
                    <h2><span>{{ $room['name'] }}</span></h2>
                    <div class="list-single-header-contacts fl-wrap">
                        <ul>
                            @if(!empty($istay['hotline']))
                                <li><i class="far fa-phone"></i><a href="javascript: void();">{{ $istay['hotline'] }}</a></li>
                            @endif
                            @if(!empty($istay['address']))
                                <li><i class="far fa-map-marker-alt"></i><a href="javascript: void();">{{ $istay['address'] }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 hidden">
                    <div class="list-single-hero-details fl-wrap">
                        <div class="list-single-hero-links">
                            <a class="lisd-link" href="#sec2"><i class="fal fa-bookmark"></i> {{ trans('labels.book_now') }}</a>
                            <a class="custom-scroll-link lisd-link hidden" href="#sec6"><i
                                        class="fal fa-comment-alt-check"></i> On The Map</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-hero-buttom fl-wrap">
                <div class="breadcrumbs">
                    <a href="/">{{ trans('labels.home') }}</a>
                    <a href="{{ route('article.istay', ['istay' => $istay['slug'], 'lang' => $lang]) }}">{{ $istay['name'] }}</a>
                    <span>{{ $room['name'] }}</span>
                </div>
                <div class="list-single-hero-price">AWG/NIGHT<span>$ {{ $room['price'] }}</span></div>
            </div>
        </div>
    </div>
</section>
