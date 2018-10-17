@extends('backend.layouts.app')

@section('title', 'Manage Products')

@section('pageId', 'product')

@section('breadcrumbs')
    <a href="{{ route('product.index') }}">Products</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Managed Products
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
                                    <a class="btn sbold blue" href="{{ route('product.create') }}"> Add New
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('backend.product.partial._product')

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('backend.product.partial._popup_event', ['events' => $events])
@endsection


@push('script')
    <script src="{{ asset('/admin/assets/scripts/products.js') }}" type="text/javascript"></script>
@endpush