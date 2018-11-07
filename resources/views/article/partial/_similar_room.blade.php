@if(!empty($similarRooms))
    <div class="box-widget-item fl-wrap">
        <div class="box-widget">
            <div class="box-widget-content">
                <div class="box-widget-item-header">
                    <h3>{{ trans('labels.similar_room') }}</h3>
                </div>
                <div class="widget-posts fl-wrap">
                    <ul>
                        @foreach($similarRooms as $similarRoom)
                        <li class="clearfix">
                            <a href="{{ route('article.details', ['room' => $similarRoom['slug'], 'lang' => $lang]) }}" class="widget-posts-img">
                                <img src="{{ $similarRoom->image }}" class="respimg" alt=""></a>
                            <div class="widget-posts-descr">
                                <a href="{{ route('article.details', ['room' => $similarRoom['slug'], 'lang' => $lang]) }}" title="">{{ $similarRoom->name }}</a>
                                <span class="similar-price">${{ $similarRoom->price }} <strong> /  Awg</strong></span>
                                <div class="geodir-category-location fl-wrap">
                                    <a href="{{ route('article.istay', ['istay' => $istay['slug'], 'lang' => $lang]) }}">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $istay['name'] }}
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif