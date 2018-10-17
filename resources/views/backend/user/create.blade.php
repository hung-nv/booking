@extends('backend.layouts.app')

@section('title', 'Create user')

@section('breadcrumbs')
    <a href="{{ route('user.index') }}">Users</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Managed User
        <small>Create</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('user.store') }}" class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        @include('backend.blocks.errors')

                        @include('backend.user.partial._form')

                        @include('backend.common.actionForm')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection