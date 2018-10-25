<tr class="odd gradeX">
    <td>{{ $item['id'] }}</td>
    <td>
        {{ $character . ' ' . $item['name_en'] }}
    </td>
    <td>{{ $item['slug'] }}</td>
    <td>
        <a href="{{ route('category.edit', ['category' => $item['id_content_'.config('const.lang.en')]]) }}"
           class="btn btn-icon-only default">
            <i class="fa fa-edit"></i>
        </a>
    </td>
    <td>
        @if(!empty($item['name_'.config('const.lang.ko')]))
            <a href="{{ route('category.edit', ['category' => $item['id_content_'.config('const.lang.ko')]]) }}"
               class="btn btn-icon-only default">
                <i class="fa fa-edit"></i>
            </a>
        @else
            <a href="{{ route('category.create', ['lang' => config('const.lang.ko')]) }}"
               class="btn btn-icon-only default">
                <i class="fa fa-plus"></i>
            </a>
        @endif
    </td>
    <td>
        @if(!empty($item['name_'.config('const.lang.vi')]))
            <a href="{{ route('category.edit', ['category' => $item['id_content_'.config('const.lang.vi')]]) }}"
               class="btn btn-icon-only default">
                <i class="fa fa-edit"></i>
            </a>
        @else
            <a href="{{ route('category.create', ['lang' => config('const.lang.vi')]) }}"
               class="btn btn-icon-only default">
                <i class="fa fa-plus"></i>
            </a>
        @endif
    </td>
    <td style="text-align: center;">
        <form action="{{ route('category.destroy', $item['id']) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="button" class="btn red btn-sm" v-on:click="confirmBeforeDelete">Delete</button>
        </form>
    </td>
</tr>