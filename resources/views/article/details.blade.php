@extends('layouts.app')

@section('title')
    {{ $room['meta_title'] or $room['name'] }}
@endsection

@section('description')
    {{ $room['meta_description'] or '' }}
@endsection

@section('content')
    <div class="content">
        @include('article.partial._banner')

        @include('article.partial._single')

        @if(!empty($istay['google-map']))
            <div id="sec6 bottom-map">
                <div class="google-map">
                    {!! $istay['google-map'] !!}
                </div>
                <div class="special-location">
                    {!! $istay['special-location'] or '' !!}
                </div>
            </div>
        @endif

        <input type="hidden" id="view_data" data-room="{{ $room['name'] }}" data-istay="{{ $istay['name'] }}">

        <div class="loading hidden">Loading&#8230;</div>
    </div>
@endsection