@extends('backend.layouts.app')

@section('title', 'Update Services')

@section('pageId', 'services')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/css/fileinput.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection

@section('breadcrumbs')
    <a href="{{ route('services.index') }}">Services</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Services
        <small>Update</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('services.update', ['services' => $services['id']]) }}"
                          class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('backend.blocks.errors')

                        @include('backend.services._form')

                        @include('backend.common.actionForm')

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/admin/assets/global/plugins/select2/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/fileinput.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/piexif.min.js') }}"
            type="text/javascript"></script>
@endpush