@extends('backend.layouts.app')

@section('title')
    Event details
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/css/search.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard')  }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('event.index') }}">Event</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Details</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Managed Event</h3>
            <div class="search-page search-content-2">

                <div class="row">
                    <div class="col-md-7">
                        <div class="search-container ">
                            <ul>
                                <li class="search-item-header">
                                    <div class="row">
                                        <div class="col-sm-9 col-xs-8">
                                            <h3>Search results...</h3>
                                        </div>
                                        <div class="col-sm-3 col-xs-4">
                                        </div>
                                    </div>
                                </li>
                                @foreach($event->products as $product)
                                    <li class="search-item clearfix">
                                        <div class="search-content">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <h2 class="search-title">
                                                        <a href="javascript:;">{{ $product->name }}</a>
                                                    </h2>
                                                    <p class="search-desc"> Price:
                                                        <a href="javascript:;">{{ number_format($product->new_price) }}</a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <p class="search-counter-number">362</p>
                                                    <p class="search-counter-label uppercase">View</p>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <p class="search-counter-number">79</p>
                                                    <p class="search-counter-label uppercase">Order</p>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <p class="search-counter-number">8</p>
                                                    <p class="search-counter-label uppercase">Order Finish</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-edit font-dark"></i>
                                    <span class="caption-subject font-dark bold uppercase">Notes</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="note note-info">
                                    <h4 class="block">Event Statistic</h4>
                                    <p>
                                        Total order: <br/>
                                        Total order finish:
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/admin/assets/scripts/search.min.js') }}" type="text/javascript"></script>
@endsection