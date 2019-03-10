<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="@yield('description')">
    <meta name="robots" content="all">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/plugins.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/color.css') }}">
</head>
<body>
@if(!empty($option['script_support']))
    {!! $option['script_support'] !!}
@endif
@include('layouts.header')

<div id="@yield('pageId')">
    @yield('content')
    <div class="clearfix"></div>
</div>

@include('layouts.footer')

<script src="{{ asset('/js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('/js/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/lodash.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('/js/slick.min.js') }}"></script>
<script src="{{ asset('/js/isotope.js') }}"></script>
<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>