@extends('layouts.app')

@section('content')
    <div class="content">
        @include('homepage.partial._sectionBanner')

        @include('homepage.partial._sectionAboutiStay')

        @include('homepage.partial._sectionFeedback')

        @include('homepage.partial._sectionPromotion')
    </div>
@endsection