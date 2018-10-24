<tr class="odd gradeX">
    <td>{{ $item->id }}</td>
    <td>
        @if (empty($item->originName))
            {{ $character . ' ' . $item->name }}
        @else
            <a class="btn btn-sm btn-success" href="/adfsa">Translate</a>
        @endif
    </td>
    <td>{{ $item->slug }}</td>
    <td>
        @if($item->status == 1)
            <span class="badge badge-info badge-roundless"> Approved </span>
        @else
            <span class="badge badge-default badge-roundless"> No </span>
        @endif
    </td>
    <td>
        <form action="{{ route('category.destroy', $item->id) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a href="{{ route('category.edit', ['category' => $item->id]) }}" class="btn red btn-sm">Update</a>
            <button type="button" class="btn red btn-sm" v-on:click="confirmBeforeDelete">Delete</button>
        </form>
    </td>
</tr>