@extends('layouts.app')

@section('content')
    <div class="content">
        @include('article.partial._banner')

        @include('article.partial._single')

        @if(!empty($istay['google-map']))
            <div id="sec6">
                {!! $istay['google-map'] !!}
            </div>
        @endif
    </div>
@endsection