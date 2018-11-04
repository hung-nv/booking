<section class="section-feedback">
    <div class="container">
        <div class="section-title">
            <div class="section-title-separator">
                <span>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </span>
            </div>
            <h2>{{ $option['comment_heading'] or '' }}</h2>
            <span class="section-separator"></span>
            <p>{{ $option['comment_description'] or '' }}</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="slider-carousel-wrap text-carousel-wrap fl-wrap">
        <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        @if(!empty($comments))
            <div class="text-carousel single-carousel fl-wrap">
                @foreach($comments as $comment)
                    <div class="slick-item">
                        <div class="text-carousel-item">
                            <div class="popup-avatar"><img src="{{ $comment->avatar }}" alt=""></div>
                            <div class="listing-rating card-popup-rainingvis"></div>
                            <div class="review-owner fl-wrap">{{ $comment->name }}</div>
                            <p> "{{ $comment->content }}"</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>