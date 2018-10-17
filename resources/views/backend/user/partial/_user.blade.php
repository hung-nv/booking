<table class="table table-striped table-bordered table-hover table-checkable order-column"
       id="datatable-users">
    <thead>
    <tr>
        <th> ID</th>
        <th> Username</th>
        <th> Name</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($data))
        @foreach($data as $i)

            <tr class="odd gradeX">
                <td> {{ $i->id }}</td>
                <td>{{ $i->username }}</td>
                <td>{{ $i->name }}</td>
                <td>
                    <form action="{{ route('user.destroy', $i->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <a href="{{ route('user.edit', ['user' => $i->id]) }}"
                           class="btn red btn-sm">Update</a>
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