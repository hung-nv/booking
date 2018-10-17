@extends('backend.layouts.app')

@section('title', 'Manage Attribute')

@section('pageId', 'attribute')

@section('content')
    <h3 class="page-title"> Managed Attribute
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="datatable-attributes">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th> Name</th>
                            <th> Type</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($data))
                            @foreach($data as $i)

                                <tr class="odd gradeX">
                                    <td> {{ $i->id }}</td>
                                    <td>{{ $i->attr_value }}</td>
                                    <td>{{ $i->attribute->name }}</td>
                                    <td>
                                        <form action="{{ route('attributeValue.destroy', $i->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="button" class="btn red btn-sm"
                                                    v-on:click="confirmBeforeDelete">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/admin/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
@endpush