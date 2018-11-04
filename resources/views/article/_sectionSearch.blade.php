<section class="grey-blue-bg small-padding" id="sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-list-controls fl-wrap mar-bot-cont">
                    <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
                </div>
                <div class="list-wrap-search lisfw fl-wrap lws_mobile">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col-list-search-input-item fl-wrap location autocomplete-container">
                                    <label>{{ trans('labels.where') }}</label>
                                    <span class="header-search-input-item-icon"><i
                                                class="fal fa-map-marker-alt"></i></span>
                                    <input type="text" placeholder="{{ $option['search_where_label'] or '' }}..."
                                           class="autocomplete-input" id="autocompleteid2"
                                           value="@if(!empty($params['where'])){{ $istaysSimple[$params['where']] or '' }}@endif"/>
                                    <a href="#"><i class="fal fa-dot-circle"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-list-search-input-item in-loc-dec date-container  fl-wrap">
                                    <label>{{ trans('labels.date_range') }}</label>
                                    <span class="header-search-input-item-icon"><i
                                                class="fal fa-calendar-check"></i></span>
                                    <input type="text" placeholder="{{ $option['search_when_label'] or '' }}" name="stay_when"
                                           value="{{ $params['dateRange'] or '' }}"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="search-input-item">
                                    <div class="range-slider-title">{{ trans('labels.price_range') }}</div>
                                    <div class="range-slider-wrap fl-wrap">
                                        <input class="range-slider" data-from="{{ $params['min'] or '50' }}"
                                               data-to="{{ $params['max'] or '1000' }}" data-step="50"
                                               data-min="50" data-max="1000" data-prefix="$">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="col-list-search-input-item fl-wrap">
                                    <button class="header-search-button">
                                        {{ $option['search_label_direct'] or '' }}
                                        <i class="far fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-list-wrap fw-col-list-wrap">
                    <div class="list-main-wrap fl-wrap card-listing">
                        <div class="listing-item-container init-grid-items fl-wrap three-columns-grid">
                            @if($rooms)
                                @foreach($rooms as $room)
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <a href="{{ route('article.details', ['room' => $room->slug]) }}"><img
                                                            src="{{ $room->image }}" alt=""></a>

                                                <div class="geodir-category-opt">
                                                    <div class="rate-class-name">
                                                        <div class="score">{{ $room->istay_name }} </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="geodir-category-content fl-wrap title-sin_item">
                                                <div class="geodir-category-content-title fl-wrap">
                                                    <div class="geodir-category-content-title-item">
                                                        <h3 class="title-sin_map">
                                                            <a href="{{ route('article.details', ['room' => $room->slug]) }}">{{ $room->name }}</a>
                                                        </h3>
                                                        <div class="geodir-category-location fl-wrap">
                                                            <a href="javascript:void()" class="map-item">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                                {{ $room->address }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="facilities-list fl-wrap">
                                                    <li><i class="fas fa-bed"></i> <span>1</span></li>
                                                    <li><i class="fas fa-male"></i> <span>2</span></li>
                                                </ul>
                                                <div class="geodir-category-footer fl-wrap">
                                                    <div class="geodir-category-price">Awg/Night
                                                        <span>$ {{ $room->price }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        {{ $rooms->appends($params)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
