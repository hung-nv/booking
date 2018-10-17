<table class="table table-striped table-bordered table-hover table-checkable order-column"
       id="datatable-page">
    <thead>
    <tr>
        <th> ID</th>
        <th> Information</th>
        <th> Created At</th>
        <th> Type</th>
        <th> Status</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($pages))
        @foreach($pages as $i)
            <tr class="odd gradeX">
                <td> {{ $i->id }}</td>
                <td>
                    <p class="font-red-mint">{{ $i->name }}</p>
                </td>
                <td>{{ $i->created_at }}</td>
                <td>
                    @if($i->system_link_type_id === $pageType)
                        <span class="badge badge-info badge-roundless"> Page </span>
                    @else
                        <span class="badge badge-warning badge-roundless"> Landing Page </span>
                    @endif
                </td>
                <td>
                    @if($i->status === 1)
                        <span class="badge badge-info badge-roundless"> Approved </span>
                    @else
                        <span class="badge badge-warning badge-roundless"> No </span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('page.destroy', $i->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        @if($i->system_link_type_id === $pageType)
                            <a href="{{ route('page.edit', ['page' => $i->id]) }}"
                               class="btn red btn-sm">Update</a>
                        @else
                            <a href="{{ route('page.editLanding', ['id' => $i->id]) }}"
                               class="btn red btn-sm">Update Landing</a>
                        @endif
                        <button type="button" class="btn red btn-sm btn-delete" v-on:click="confirmBeforeDelete">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>