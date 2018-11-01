@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/pages/css/error.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('title', '404 Not found')

@section('content')
    <h1 class="page-title"> 404</h1>

    <div class="row">
        <div class="col-md-12 page-500">
            <div class=" number font-red">404 error</div>
            <div class=" details">
                <h3>Not Found.</h3>
                <p>
                    <a href="{{ route('admin.dashboard') }}" class="btn red btn-outline"> Return home </a>
                    <br>
                </p>
            </div>
        </div>
    </div>
@endsection