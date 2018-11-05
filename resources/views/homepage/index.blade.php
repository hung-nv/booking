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
        @include('homepage.partial._sectionPromotion')

        @include('homepage.partial._sectionBanner')

        @include('homepage.partial._sectionAboutiStay')

        @include('homepage.partial._sectionFeedback')

        <input type="hidden" id="viewData" data-istays="{{ json_encode($istays) }}">
    </div>
@endsection