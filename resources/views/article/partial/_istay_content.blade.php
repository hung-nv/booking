<div class="col-md-8">
    <div class="list-single-main-container ">
        <div class="list-single-main-media fl-wrap">
            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">

                @for($i = 1; $i <= 6; $i++)
                    @if(!empty($istay['gallery-image-'.$i]))
                        <div class="gallery-item @if($i == 3) gallery-item-second @endif">
                            <div class="grid-item-holder">
                                <div class="box-item">
                                    <img src="/img/800/530/{{ $istay['gallery-image-'.$i] }}">
                                    <a href="{{ $istay['gallery-image-'.$i] }}" class="gal-link popup-image"><i
                                                class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>

        @if(!empty($istay['about1-title']))
            <div class="list-single-main-item fl-wrap">
                <div class="list-single-main-item-title fl-wrap">
                    <h3>{{ $istay['about1-title'] }} </h3>
                </div>
                @if(!empty($istay['about1-description']))
                    <p>{!! str_replace("\n", "<br />", $istay['about1-description']) !!}</p>
                @endif
            </div>
        @endif
        <div class="list-single-main-item fl-wrap" id="sec3">
            <div class="list-single-main-item-title fl-wrap">
                <h3>Amenities</h3>
            </div>
            <div class="listing-features fl-wrap">
                @if(!empty($services))
                    <ul>
                        @foreach($services as $service)
                            <li><i class="{{ $service->icon }}"></i> {{ $service->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="accordion mar-top">
            @if(!empty($istay['about2-title']))
                <a class="toggle" href="#"> {{ $istay['about2-title'] }} <span></span></a>
                <div class="accordion-inner">
                    @if(!empty($istay['about2-description']))
                        <p>{!! str_replace("\n", "<br />", $istay['about2-description']) !!}</p>
                    @endif
                </div>
            @endif
            @if(!empty($istay['about3-title']))
                <a class="toggle" href="#">{{ $istay['about3-title'] }}<span></span></a>
                <div class="accordion-inner">
                    @if(!empty($istay['about2-description']))
                        <p>{!! str_replace("\n", "<br />", $istay['about3-description']) !!}</p>
                    @endif
                </div>
            @endif
            @if(!empty($istay['about4-title']))
                <a class="toggle" href="#">{{ $istay['about4-title'] }}<span></span></a>
                <div class="accordion-inner">
                    <p>{!! str_replace("\n", "<br />", $istay['about4-description']) !!}</p>
                </div>
            @endif
            @if(!empty($istay['about5-title']))
                <a class="toggle" href="#">{{ $istay['about5-title'] }}<span></span></a>
                <div class="accordion-inner">
                    <p>{!! str_replace("\n", "<br />", $istay['about5-description']) !!}</p>
                </div>
            @endif
        </div>


        @if($roomsAvailable)
            <div class="list-single-main-item fl-wrap" id="sec4">
                <div class="list-single-main-item-title fl-wrap">
                    <h3>{{ trans('labels.available_rooms') }}</h3>
                </div>
                <div class="rooms-container fl-wrap">
                    @foreach($roomsAvailable as $room)
                        <div class="rooms-item fl-wrap">
                            <div class="rooms-media">
                                <img src="{{ $room['image'] }}" alt="">
                                <div class="dynamic-gal more-photos-button"
                                     data-dynamicPath="[{'src': '{{ $room['gallery-image-1'] or '' }}'}, {'src': '{{ $room['gallery-image-2'] or '' }}'},{'src': '{{ $room['gallery-image-3'] or '' }}'}]">
                                    {{ trans('labels.view_gallery') }} <span>3 {{ trans('labels.photos') }}</span> <i class="far fa-long-arrow-right"></i></div>
                            </div>
                            <div class="rooms-details">
                                <div class="rooms-details-header fl-wrap">
                                    <span class="rooms-price">${{ $room['price'] }}</span>
                                    <h3>{{ $room['name'] }}</h3>
                                </div>
                                <p>
                                    @if(!empty($room['overview-content']))
                                        {!! str_replace("\n", "<br />", str_limit($room['overview-content'], 150)) !!}
                                    @endif
                                </p>
                                <div class="facilities-list fl-wrap">
                                    <a href="{{ route('article.details', ['room' => $room['slug'], 'lang' => $lang]) }}"
                                       class="btn color-bg ajax-link">
                                        Details
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

    </div>
</div>