@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title')
    Manage Event
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
                        <span>All</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Managed Event</h3>

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
                                            <a class="btn sbold blue" href="{{ route('event.create') }}">
                                                Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-event">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Name</th>
                                    <th> Total items</th>
                                    <th> Start time </th>
                                    <th> End time </th>
                                    <th> Status</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $i)
                                        <tr class="odd gradeX">
                                            <td> {{ $i->id }}</td>
                                            <td>
                                                {{ $i->name }}
                                            </td>
                                            <td class="data-middle">{{ count($i->products) }}</td>
                                            <td class="data-middle">{{ $i->start_at }}</td>
                                            <td class="data-middle">{{ $i->end_at }}</td>
                                            <td class="data-middle">
                                                @if($i->status === 1)
                                                    <span class="badge badge-info badge-roundless"> Approved </span>
                                                @else
                                                    <span class="badge badge-default badge-roundless"> No </span>
                                                @endif
                                            </td>
                                            <td class="data-middle">
                                                <form action="{{ route('event.destroy', $i->id) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <a href="{{ route('event.show', ['event' => $i->id]) }}"
                                                        class="btn red btn-sm">Show</a>
                                                    <a href="{{ route('event.edit', ['event' => $i->id]) }}"
                                                        class="btn red btn-sm">Update</a>
                                                    <button type="submit" class="btn red btn-sm btn-delete">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <script src="{{ asset('/admin/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>

    <script>
        $(function () {
            $("#data-event").dataTable({
                ordering: false,
                order: [[0, 'desc']],
                bLengthChange: true,
                bFilter: true
            });
        });

        $('#data-event').on('click', '.btn-delete', function () {
            var confirmDel = confirm('Do you want to delete this event?');
            if (confirmDel) {
                this.parent().submit();
            } else {
                return false;
            }
        });

    </script>
@endsection