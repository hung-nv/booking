<div class="col-md-8">
    <div class="list-single-main-container ">
        <div class="list-single-main-media fl-wrap">
            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">

                @for($i = 1; $i <= 6; $i++)
                    @if(!empty($room['gallery-image-'.$i]))
                        <div class="gallery-item @if($i == 3) gallery-item-second @endif">
                            <div class="grid-item-holder">
                                <div class="box-item">
                                    <img src="/img/800/530/{{ $room['gallery-image-'.$i] }}">
                                    <a href="{{ $room['gallery-image-'.$i] }}" class="gal-link popup-image"><i
                                                class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>

        @if(!empty($room['about1-title']))
            <div class="list-single-main-item fl-wrap">
                <div class="list-single-main-item-title fl-wrap">
                    <h3>{{ $room['about1-title'] }} </h3>
                </div>
                @if(!empty($room['about1-description']))
                    <p>{!! str_replace("\n", "<br />", $room['about1-description']) !!}</p>
                @endif
            </div>
        @endif
        <div class="list-single-main-item fl-wrap" id="sec3">
            <div class="list-single-main-item-title fl-wrap">
                <h3>{{ $room['feature-heading'] or 'Services' }}</h3>
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
            @if(!empty($room['about2-title']))
                <a class="toggle" href="#"> {{ $room['about2-title'] }} <span></span></a>
                <div class="accordion-inner">
                    @if(!empty($room['about2-description']))
                        <p>{!! str_replace("\n", "<br />", $room['about2-description']) !!}</p>
                    @endif
                </div>
            @endif
            @if(!empty($room['about3-title']))
                <a class="toggle" href="#">{{ $room['about3-title'] }}<span></span></a>
                <div class="accordion-inner">
                    @if(!empty($room['about2-description']))
                        <p>{!! str_replace("\n", "<br />", $room['about3-description']) !!}</p>
                    @endif
                </div>
            @endif
            @if(!empty($room['about4-title']))
                <a class="toggle" href="#">{{ $room['about4-title'] }}<span></span></a>
                <div class="accordion-inner">
                    <p>{!! str_replace("\n", "<br />", $room['about4-description']) !!}</p>
                </div>
            @endif
            @if(!empty($room['about5-title']))
                <a class="toggle" href="#">{{ $room['about5-title'] }}<span></span></a>
                <div class="accordion-inner">
                    <p>{!! str_replace("\n", "<br />", $room['about5-description']) !!}</p>
                </div>
            @endif
        </div>
    </div>
</div>