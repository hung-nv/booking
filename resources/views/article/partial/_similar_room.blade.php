@if(!empty($similarRooms))
    <div class="box-widget-item fl-wrap">
        <div class="box-widget">
            <div class="box-widget-content">
                <div class="box-widget-item-header">
                    <h3>Similar Listings</h3>
                </div>
                <div class="widget-posts fl-wrap">
                    <ul>
                        @foreach($similarRooms as $similarRoom)
                        <li class="clearfix">
                            <a href="#" class="widget-posts-img">
                                <img src="{{ $similarRoom->image }}" class="respimg" alt=""></a>
                            <div class="widget-posts-descr">
                                <a href="#" title="">{{ $similarRoom->name }}</a>
                                <div class="geodir-category-location fl-wrap">
                                    <a href="{{ route('article.istay', ['istay' => $istay['slug']]) }}">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $istay['name'] }}
                                    </a>
                                </div>
                                <span class="rooms-price">${{ $similarRoom->price }} <strong> /  Awg</strong></span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif