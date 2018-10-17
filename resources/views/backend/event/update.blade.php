@extends('backend.layouts.app')

@section('title')
    Manage Events
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('event.index') }}">Events</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Category</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue-haze">
                                <i class="icon-settings font-blue-haze"></i>
                                <span class="caption-subject bold uppercase"> Update Event #{{ $event['id'] }}</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                                   data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ route('event.update', ['event' => $event['id']]) }}" class="form-horizontal" role="form"
                                  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-body">

                                    @include('backend.blocks.errors')

                                    @include('backend.event._form')

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('/admin/assets/global/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#start-time').datetimepicker();
        $('#end-time').datetimepicker();
    </script>
@endsection