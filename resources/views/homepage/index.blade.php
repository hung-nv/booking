@extends('layouts.app')

@section('pageId', 'homepage')

@section('content')
    <div class="content">
        @include('homepage.partial._sectionBanner')

        @include('homepage.partial._sectionPromotion')

        @include('homepage.partial._sectionAboutiStay')

        @include('homepage.partial._sectionFeedback')
    </div>
@endsection