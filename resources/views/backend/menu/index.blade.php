@extends('backend.layouts.app')

@section('title', 'Manage Menu')

@section('pageId', 'menu')

@section('breadcrumbs')
    <a href="{{ route('setting.menu') }}">Menu</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Menu
        <small>All</small>
    </h3>

    @include('backend.blocks.message')

    <div class="portlet light bordered">
        <div class="portlet-body ">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-2" id="selected-menu">
                            @include('backend.menu.partial._menu_select')
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-sm blue" type="button" v-on:click="selectMenuGroup">Select</button>
                            <button class="btn btn-sm yellow" type="button" data-toggle="modal" href="#modalAddMenu">
                                Add Menu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="portlet light bordered hidden">
        <div class="portlet-body ">
            <div class="row">
                <div class="col-md-12">
                    <textarea id="nestable_list_2_output" class="form-control col-md-12 margin-bottom-10"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="row wrap-content-menu" @if(Request::get('menu_group')) style="display: block" @endif>
        <div class="col-md-5">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue sbold uppercase">Add Link to Menu</span>
                    </div>
                </div>
                <div class="portlet-body ">
                    <div class="panel-group accordion" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_1"> Category </a>
                                </h4>
                            </div>
                            <div id="collapse_1" class="panel-collapse in">
                                <div class="panel-body wrap-menu-category">
                                    <div class="mt-checkbox-list"
                                         data-error-container="#form_2_services_error">
                                        {!! $templateCategory !!}
                                    </div>
                                    <button class="btn btn-sm blue" v-on:click="addCategoryToMenu">Add to menu</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_2"> Custom Link </a>
                                </h4>
                            </div>
                            <div id="collapse_2" class="panel-collapse collapse">
                                <div class="panel-body wrap-menu-custom">
                                    <form id="frmCustom">
                                        <div class="form-group">
                                            <label>Direct Url</label>
                                            <input class="form-control" type="url" v-model="customDirect" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Label</label>
                                            <input class="form-control" type="text" v-model="customLabel" required>
                                        </div>
                                        <button class="btn btn-sm blue" type="button" v-on:click="addCustomToMenu">
                                            Add to menu
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_3"> Page </a>
                                </h4>
                            </div>
                            <div id="collapse_3" class="panel-collapse collapse">
                                <div class="panel-body wrap-menu-pages">
                                    <div class="mt-checkbox-list"
                                         data-error-container="#form_2_services_error">
                                        @if($pages)
                                            @foreach($pages as $page)
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" value="{{ $page['id'] }}"
                                                           name="page[]">{{ $page['name'] }}
                                                    <span></span>
                                                </label>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button class="btn btn-sm blue" v-on:click="addPageToMenu">Add to menu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Menu</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="dd" id="nestable_list_2">
                        {!! $templateMenu !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.menu._add_menu')
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/admin/assets/global/plugins/jquery-nestable/jquery.nestable.js') }}"
            type="text/javascript"></script>
@endpush