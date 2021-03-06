@extends('backend.layouts.app')

@section('title')
    Manage Branch
@endsection

@section('breadcrumbs')
    <a href="{{ route('branch.index') }}">Branches</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Managed Branch
        <small>Create</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('branch.store') }}" class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                            @include('backend.blocks.errors')

                            @include('backend.branch._form')

                            @include('backend.common.actionForm')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection