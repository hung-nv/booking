@extends('backend.layouts.app')

@section('title', 'Update User')

@section('breadcrumbs')
    <a href="{{ route('user.index') }}">Users</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Managed Users
        <small>Update</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('user.update', ['user' => $data['id']]) }}" role="form"
                          class="form-horizontal form-row-seperated"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('backend.blocks.errors')

                        @include('backend.user.partial._form')

                        @include('backend.common.actionForm')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection