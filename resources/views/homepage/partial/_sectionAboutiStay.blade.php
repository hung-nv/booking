<section id="sec2" class="section-istay">
    <div class="container">
        <div class="section-title">
            <div class="section-title-separator">
                <span>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </span>
            </div>
            <h2>{{ $option['about_heading'] or '' }}</h2>
            <span class="section-separator"></span>
            <p>{{ $option['about_description'] or '' }}</p>
        </div>
    </div>
    <div class="gallery-items fl-wrap mr-bot spad home-grid">
        @if(!empty($istays))
            @foreach($istays as $istay)
                <div class="gallery-item">
                    <div class="grid-item-holder">
                        <div class="listing-item-grid">
                            {{--@if($loop->index === 1)--}}
                                {{--<img src="/img/1246/414{{ $istay['image'] }}">--}}
                                {{--<div class="listing-counter">{{ $istay['range-price'] or '' }}</div>--}}
                            {{--@else--}}
                                <div class="listing-counter">{{ $istay['range-price'] or '' }}</div>
                                <img src="{{ $istay['image'] }}">
                            {{--@endif--}}
                            <div class="listing-item-cat">
                                <h3><a href="{{ route('article.istay', ['istay' => $istay['slug'], 'lang' => $lang]) }}">{{ $istay['name'] }}</a></h3>
                                <div class="clearfix"></div>
                                <p>{{ $istay['address'] or '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>