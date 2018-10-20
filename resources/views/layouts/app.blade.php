<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="robots" content="all">
    <title>Hệ thống khách sạn iStay</title>

    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/plugins.css') }}">
    <!-- Bootstrap Core CSS -->
{{--<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">--}}
<!-- Icons/Glyphs -->
    {{--<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">--}}

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{--<link rel="stylesheet" href="{{ asset('/css/slick.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/color.css') }}">
</head>
<body>
@include('layouts.header')

<div id="wrapper @yield('pageId')">
    @yield('content')
    <div class="clearfix"></div>
</div>

@include('layouts.footer')

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('/js/owl.carousel.min.js') }}"></script>--}}
{{--<script src="{{ asset('/js/bootstrap-slider.min.js') }}"></script>--}}
{{--<script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('/js/slick.min.js') }}"></script>
<script src="{{ asset('/js/isotope.js') }}"></script>
<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>