<table class="table table-striped table-bordered table-hover table-checkable order-column">
    <thead>
    <tr>
        <th> ID</th>
        <th> Information</th>
        <th> Created At</th>
        <th> Groups</th>
        <th> Status</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $i)
        <tr class="odd gradeX">
            <td> {{ $i->id }}</td>
            <td>
                <p class="font-red-mint">{{ $i->name }}</p>
                @if($i->description)
                    <blockquote>
                        <small>{{ $i->description }}</small>
                    </blockquote>
                @endif
            </td>
            <td class="data-middle">{{ $i->created_at }}</td>
            <td class="data-middle">
                @foreach($groups as $j)
                    <p class="margin-bottom-10">
                        @if(in_array($j->id, joinGroup($i->groups)))
                            <a href="javascript:;" class="btn btn-xs blue">
                                <i class="fa fa-check"></i>
                                {{ $j->value }}
                            </a>
                            <button class="btn btn-xs red" onclick="mainComponent.removeGroup(this)"
                                    data-post-id="{{ $i->id }}"
                                    data-group-name="{{ $j->value }}"
                                    data-group-id="{{ $j->id }}">
                                <i class="fa fa-times"></i>
                            </button>
                        @else
                            <button class="btn btn-xs grey-cascade" onclick="mainComponent.addGroup(this)"
                                    data-post-id="{{ $i->id }}"
                                    data-group-name="{{ $j->value }}"
                                    data-group-id="{{ $j->id }}"> Set to "{{ $j->value }}"
                            </button>
                        @endif
                    </p>
                @endforeach

            </td>
            <td class="data-middle">
                @if($i->status === 1)
                    <span class="badge badge-info badge-roundless"> Approved </span>
                @else
                    <span class="badge badge-default badge-roundless"> No </span>
                @endif
            </td>
            <td class="data-middle">
                <form action="{{ route('post.destroy', $i->id) }}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <a href="{{ route('post.edit', ['post' => $i->id]) }}"
                       class="btn red btn-sm">Update</a>
                    <button type="button" class="btn red btn-sm" v-on:click="confirmBeforeDelete">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>