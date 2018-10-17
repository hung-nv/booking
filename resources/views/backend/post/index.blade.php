@extends('backend.layouts.app')

@section('title', 'Manage Posts')

@section('pageId', 'post')

@section('breadcrumbs')
    <a href="{{ route('post.index') }}">Posts</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Manage Posts
        <small>All</small>
    </h3>

    @include('backend.blocks.message')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Data</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a class="btn sbold green" href="{{ route('post.create') }}">
                                        Insert
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dataTables_wrapper dataTables_extended_wrapper no-footer">
                        @include('backend.post._post')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection