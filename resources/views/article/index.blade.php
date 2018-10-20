@extends('layouts.app')

@section('content')
    <div class="content">
        @include('homepage.partial._sectionBanner')

        <div class="breadcrumbs-fs fl-wrap">
            <div class="container">
                <div class="breadcrumbs fl-wrap">
                    <a href="/">Home</a>
                    <a href="#">Listings</a>
                    <span>Search</span>
                </div>
            </div>
        </div>

        @include('article._sectionSearch')
    </div>
@endsection