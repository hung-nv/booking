@extends('layouts.app')

@section('pageId', 'homepage')

@section('title')
    {{ $option['meta_title'] or '' }}
@endsection

@section('description')
    {{ $option['meta_description'] or '' }}
@endsection

@section('content')
    <div class="content">
        {{--@include('homepage.partial._sectionPromotion')--}}

        @include('homepage.partial._sectionBanner')

        @include('homepage.partial._sectionAboutiStay')

        @include('homepage.partial._sectionFeedback')

        <input type="hidden" id="viewData" data-istays="{{ json_encode($istays) }}">

        @if(!empty($option['promotion_background']))
            <div class="modal fade bs-example-modal-lg" id="popupPromotion" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="img-promotion">
                            <div class="close-modal">
                                <i class="fal fa-times-circle"></i>
                            </div>
                            <a href="{{ $option['promotion_booking_url'] or '/search?lang='.$lang }}">
                                <img src="{{ $option['promotion_background'] }}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection