@extends('layouts.app')

@section('title')
    {{ $option['meta_title'] or '' }}
@endsection

@section('description')
    {{ $option['meta_description'] or '' }}
@endsection

@section('pageId', 'search')

@section('content')
    <div class="content">
        @include('homepage.partial._sectionBanner')

        <div class="breadcrumbs-fs fl-wrap">
            <div class="container">
                <div class="breadcrumbs fl-wrap">
                    <a href="/?lang={{ $lang }}">{{ trans('labels.home') }}</a>
                    <span>Search</span>
                </div>
            </div>
        </div>

        @include('article._sectionSearch')

        @include('homepage.partial._sectionPromotion')

        <input type="hidden" id="viewData" data-istays="{{ json_encode($istays) }}">
    </div>
@endsection