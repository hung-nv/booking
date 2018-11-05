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
            <div id="sec6">
                {!! $istay['google-map'] !!}
            </div>
        @endif
    </div>
@endsection