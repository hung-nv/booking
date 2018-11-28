@extends('layouts.app')

@section('title')
    {{ $istay['meta_title'] or $istay['name'] }}
@endsection

@section('description')
    {{ $istay['meta_description'] or '' }}
@endsection

@section('content')
    <div class="content">
        @include('article.partial._banner_istay')

        @include('article.partial._single_istay')

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
    </div>
@endsection